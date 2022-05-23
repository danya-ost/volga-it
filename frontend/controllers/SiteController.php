<?php

namespace frontend\controllers;

use frontend\models\Dictionaries;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\models\Words;
use Yii;
use yii\base\BaseObject;
use yii\base\DynamicModel;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $modelImport = new DynamicModel([
            'fileImport' => 'File Import',
        ]);
        $modelImport->addRule(['fileImport'],'file');
        $modelImport->addRule(['fileImport'],'required',['message' => 'Выберите файл для импорта!']);

        $modelImportZip = new DynamicModel([
            'fileImportZip' => 'File Import Zip'
        ]);
        $modelImportZip->addRule(['fileImportZip'],'file');
        $modelImportZip->addRule(['fileImportZip'],'required',['message' => 'Выберите файл для импорта!']);

        $modelDictionaries = new Dictionaries();

        if ( Yii::$app->request->isAjax )
        {

            //Загрузка словаря
            $modelImport->fileImport = UploadedFile::getInstance($modelImport,'fileImport');
            if($modelImport->fileImport && $modelImport->validate())
            {
                if (($handle = fopen($modelImport->fileImport->tempName, 'r')) !== false)
                {

                    $modelDictionaries->load( Yii::$app->request->post() );
                    $modelDictionaries->save();
                    $dictionaries_id = $modelDictionaries->id;

                    $iteration = 0;
                    while (($row = fgetcsv($handle, 1000, ";")) !== false)
                    {
                        if ( $iteration == 1 )
                        {
                            if( $row[0] != '' && $row[1] != '')
                            {
                                $modelWords = new Words();
                                $modelWords->dictionaries_id = $dictionaries_id;
                                $modelWords->word_en = $row[0];
                                $modelWords->word_ru = $row[1];
                                $modelWords->image_name = $row[2];
                                if ($modelWords->validate()) {
                                    $modelWords->save();
                                }
                            } else{
                                $modelDictionaries = Dictionaries::find()->where(['id' => $dictionaries_id])->one();
                                $modelDictionaries->delete();
                            }
                        }
                        $iteration = 1;
                    }
                    fclose($handle);

                }
                return 'Загрузка произведена успешно!';
            }


            //Загрузка zip
            $modelImportZip->fileImportZip = UploadedFile::getInstance($modelImportZip,'fileImportZip');
            if($modelImportZip->fileImportZip && $modelImportZip->validate())
            {
                if( $zipArchive = Yii::$app->zipper->open($modelImportZip->fileImportZip->tempName, 'zip') )
                {
                    $zipArchive->extract(Yii::getAlias('@frontend') . '/web/files/');
                    return 'ZIP успешно распакован';
                }

            }
        }

        $modelDictionariesRead = Dictionaries::find()->all();

        $modelFirstOpenDictionaries = Dictionaries::find()->where(['id' => 1])->one();
        $modelFirstOpenWords = Words::find()->where(['dictionaries_id' => 1])->all();

        $modelWordsAll = Words::find()->all();

        return $this->render('index', [
            'modelImport' => $modelImport,
            'modelImportZip' => $modelImportZip,
            'modelDictionaries' => $modelDictionaries,
            'modelDictionariesRead' => $modelDictionariesRead,
            'modelFirstOpenDictionaries' => $modelFirstOpenDictionaries,
            'modelFirstOpenWords' => $modelFirstOpenWords,
            'modelWordsAll' => $modelWordsAll
        ]);
    }

    public function actionLoadDictionaries()
    {
        if ( Yii::$app->request->isAjax )
        {
            $modelDictionariesRead = Dictionaries::find()->all();

            return $this->renderAjax('load-dictionaries', [
                'modelDictionariesRead' => $modelDictionariesRead
            ]);
        }
    }

    public function actionReloadCards()
    {
        if( Yii::$app->request->isAjax )
        {
            $_dict_id = Yii::$app->request->post('_dict_id');

            $modelDictionaries = Dictionaries::find()->where([ 'id' => $_dict_id ])->one();
            $modelWords = Words::find()->where([ 'dictionaries_id' => $_dict_id ])->all();

            return $this->renderAjax('reload-cards', [
                'modelDictionaries' => $modelDictionaries,
                'modelWords' => $modelWords
            ]);
        }
    }

    public function actionReloadLang()
    {
        if( Yii::$app->request->isAjax )
        {
            return $this->renderAjax('reload-lang');
        }
    }

    public function actionSearchWords()
    {
        if( Yii::$app->request->isAjax )
        {
            $_value_search = Yii::$app->request->post( '_value_search' );

            return $this->renderAjax('search-words', [
                '_value_search' => $_value_search
            ]);
        }
    }

    public function actionSearchWordsAllView()
    {
        if( Yii::$app->request->isAjax )
        {
            $modelWords = Words::find()->all();

            return $this->renderAjax('search-words-all-view', [
                'modelWords' => $modelWords
            ]);
        }
    }
}
