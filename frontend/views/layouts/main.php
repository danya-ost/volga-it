<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/logo_v-it.png" type="image/x-icon" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="min-w-[640px] m-auto overflow-hidden">
<?php $this->beginBody() ?>

    <header class="w-full h-auto md:h-[150px]">
        <div class="container xl:max-w-[1280px] h-full m-auto md:flex md:justify-between md:items-center px-5 md:px-0">
            <a href="<?= Yii::$app->urlManager->baseUrl; ?>" class="h-auto text-mc mt-8 md:mt-0" style="display: block;">
                <svg class="w-[60px] h-[60px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                </svg>
            </a>
            <div id="lang" class="h-[60px] px-8 py-2.5 border-2 border-mc border-solid rounded-[50px] mt-8 md:mt-0 cursor-pointer relative flex items-center justify-between select-none">
                <div id="flag_left" class="duration-300 ease-in-out">
                    <img src="/frontend/web/images/flags/gb.png">
                </div>
                <div class="text-mc font-bold px-2.5 duration-300 ease-in-out overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="arrow h-6 w-6 translate-y-[50%] duration-300 ease-in-out" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="arrow-hover h-6 w-6 relative translate-y-[100%] duration-300 ease-in-out" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <div id="flag_right" class="duration-300 ease-in-out">
                    <img src="/frontend/web/images/flags/ru.png">
                </div>
            </div>
            <div id="nav" class="bg-mc rounded-[50px] px-2.5 py-2.5 flex justify-between items-center mt-8 md:mt-0">
                <a data-tab-link="education" class="mr-[5px] text-mc bg-white font-open-sans text-base font-semibold px-5 py-2.5 rounded-[30px] cursor-pointer nav__item duration-300 ease-in-out select-none">Обучение</a>
                <a data-tab-link="selected" class="ml-[5px] text-white bg-mc font-open-sans text-base font-semibold px-5 py-2.5 rounded-[30px] cursor-pointer nav__item duration-300 ease-in-out select-none">Выбрать словарь</a>
                <a data-tab-link="load-file" class="ml-[5px] text-white bg-mc font-open-sans text-base font-semibold px-5 py-2.5 rounded-[30px] cursor-pointer nav__item duration-300 ease-in-out select-none">Загрузить словарь</a>
            </div>
        </div>
    </header>

    <main role="main" class="w-full h-auto">
        <?= $content ?>
    </main>

    <footer role="green" class="w-full h-[20px] fixed right-0 bottom-0 left-0 bg-ac duration-300 ease-in-out translate-y-[100%]" style="z-index: 900">
        <div class="container xl:max-w-[1280px] h-full m-auto">
            <h6 class="font-open-sans font-bold text-sm text-center text-white">
            </h6>
        </div>
    </footer>

    <footer role="red" class="w-full h-[20px] fixed right-0 bottom-0 left-0 bg-[#FF0000] duration-300 ease-in-out translate-y-[100%]" style="z-index: 900">
        <div class="container xl:max-w-[1280px] h-full m-auto">
            <h6 class="font-open-sans font-bold text-sm text-center text-white">
            </h6>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
