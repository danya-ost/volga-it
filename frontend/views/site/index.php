<?php

/** @var yii\web\View $this */

use yii\widgets\ActiveForm;

$this->title = 'Education';
?>
<style>
    .cust-scroll::-webkit-scrollbar {
        width: 12px;               /* ширина scrollbar */
    }
    .cust-scroll::-webkit-scrollbar-track {
        background: #F3F3F3;        /* цвет дорожки */
    }
    .cust-scroll::-webkit-scrollbar-thumb {
        background-color: #9D9E9E;    /* цвет плашки */
        border-radius: 20px;       /* закругления плашки */
        border: 3px solid #F3F3F3;  /* padding вокруг плашки */
    }
</style>

<div data-tab="education" class="tab w-full h-full relative duration-200 ease-in-out">
    <div id="load-education-preload" class="absolute top-0 right-0 bottom-0 left-0 backdrop-blur-md flex items-center justify-center hidden">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div id="education_cards" class="w-full h-[600px]">
        <div id="education_cards" class="container xl:max-w-[1280px] h-full m-auto overflow-hidden">
            <div class="w-full h-full overflow-hidden">
                <div id="word-slide" class="w-full h-auto duration-300 ease-in-out">

                    <?php $iteration_words = 1; ?>
                    <?php foreach ( $modelFirstOpenWords as $item ) : ?>

                        <div data-scroll-id="<?= $iteration_words; ?>" id="word-slide__item" class="word-slide__item max-w-[500px] h-[550px] p-8 m-auto rounded-[15px] shadow-[0px_0px_25px_0px] shadow-[#0000000F] flex items-center justify-center mt-10" style="background-image: linear-gradient(315deg, rgba(115, 139, 219, 0.1) 0%, rgba(28, 171, 237, 0.1) 74%);">
                            <div class="w-full h-auto">
                                <img class="h-[200px] m-auto" src="/frontend/web/files/<?= $item['image_name'] ?>">
                                <h3 data-scroll-tab="main-text-<?= $iteration_words; ?>" class="mt-8 font-rubic font-semibold text-5xl text-mdc text-center uppercase">
                                    <?= $item['word_en'] ?>
                                </h3>
                                <h3 data-scroll-tab="mask-<?= $iteration_words; ?>" class="mt-8 font-rubic font-medium text-4xl text-ac text-center uppercase">??????????</h3>
                                <h3 data-scroll-tab="text-<?= $iteration_words; ?>" class="mt-8 font-rubic font-medium text-4xl text-ac text-center uppercase hidden">
                                    <?= $item['word_ru'] ?>
                                </h3>
                            </div>
                        </div>

                        <?php $iteration_words++; ?>
                    <?php endforeach; ?>

                    <?php $count_cards = count( $modelFirstOpenWords ); ?>
                    <?php if ( $count_cards == 0 ) : ?>
                        <div class="max-w-[500px] h-auto p-8 m-auto rounded-[15px] shadow-[0px_0px_25px_0px] shadow-[#0000000F] flex items-center justify-center mt-10" style="background-image: linear-gradient(315deg, rgba(115, 139, 219, 0.1) 0%, rgba(28, 171, 237, 0.1) 74%);">
                            <div class="w-full h-auto">
                            <span class="font-open-sans font-semibold text-center text-mdc text-base duration-300 ease-in-out hover:text-mc">
                                Ничего не найдено...
                            </span>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="container max-w-[500px] pt-20 m-auto px-5 md:px-0">
            <div class="flex items-center justify-between">
                <button data-current-scroll-id="1" class="translate font-open-sans font-semibold text-base text-white bg-ac px-5 py-5 rounded-[50px] hover:ring-2 hover:ring-ac hover:ring-offset-2 hover:ring-offset-white duration-300 ease-in-out cursor-pointer view-word select-none disabled:bg-mgc disabled:cursor-not-allowed disabled:ring-mgc" <?= ( $count_cards == 0 ) ? 'disabled' : '' ?> >Показать перевод</button>
                <button class="font-open-sans font-semibold text-base text-white bg-mc px-5 py-5 rounded-[50px] hover:ring-2 hover:ring-mc hover:ring-offset-2 hover:ring-offset-white duration-300 ease-in-out cursor-pointer next-word select-none disabled:bg-mgc disabled:cursor-not-allowed disabled:ring-mgc" <?= ( $count_cards == 0 ) ? 'disabled' : '' ?> >Следующее слово</button>
            </div>
            <div class="w-full h-auto">
                <?php if ( isset( $modelFirstOpenDictionaries ) ) : ?>
                    <h6 class="current-dictionary font-rubic font-medium text-sm text-mc text-center py-5">Текущий словарь: <?= $modelFirstOpenDictionaries['name'] ?></h6>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div data-tab="selected" class="tab w-full h-full relative duration-200 ease-in-out translate-y-[150%] hidden">
    <div id="load-dictionaries-preload" class="absolute top-0 right-0 bottom-0 left-0 backdrop-blur-md flex items-center justify-center hidden">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="container xl:max-w-[1280px] h-[600px] m-auto overflow-hidden">
        <div id="all-dictionaries" class="max-w-[500px] h-[550px] p-8 m-auto rounded-[15px] shadow-[0px_0px_25px_0px] shadow-[#0000000F] overflow-y-auto cust-scroll mt-8 relative">

            <h2 class="font-rubic font-semibold text-mdc text-3xl uppercase">Доступные словари</h2>
            <br>
            <div id="sub-tab-nav" class="w-full h-[50px] flex items-stretch justify-between">
                <button data-tab-link="selected-words" class="sub-tab block w-full bg-ac text-center font-open-sans font-semibold text-base text-white cursor-pointer hover:opacity-70 duration-300 ease-in-out rounded-[50px]" >Все слова</button>
            </div>
            <br>

            <?php
                $count_modelDictionariesRead = count( $modelDictionariesRead );
                $iteration = 1;
            ?>

            <?php foreach ( $modelDictionariesRead as $item ) : ?>

                <div class="w-full h-[50px] flex items-center justify-start">
                    <?php if ( $iteration == 1 ) : ?>
                        <a data-dictionaries-id="<?= $item['id'] ?>" id="dictionary-selected" class="dictionary-selected font-open-sans font-semibold text-center text-mdc text-base cursor-pointer duration-300 ease-in-out hover:text-mc flex items-center justify-start">
                            <span class="text-ac" style="margin-right: 10px;"><?= $item['name'] ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if ( $iteration != 1 ) : ?>
                        <a data-dictionaries-id="<?= $item['id'] ?>" id="dictionary-selected" class="dictionary-selected font-open-sans font-semibold text-center text-mdc text-base cursor-pointer duration-300 ease-in-out hover:text-mc flex items-center justify-start">
                            <span style="margin-right: 10px;"><?= $item['name'] ?></span>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if ( $count_modelDictionariesRead != $iteration ) : ?>
                    <hr>
                <?php endif; $iteration++; ?>

            <?php endforeach; ?>

            <?php if ( $count_modelDictionariesRead == 0 ) : ?>
                <div class="w-full h-[50px] flex items-center justify-start">
                    <span class="font-open-sans font-semibold text-center text-mdc text-base duration-300 ease-in-out hover:text-mc">
                        Ничего не найдено...
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div data-tab="selected-words" class="tab w-full h-full relative duration-200 ease-in-out translate-y-[150%] hidden">
    <div class="absolute top-0 right-0 bottom-0 left-0 backdrop-blur-md flex items-center justify-center hidden">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="container xl:max-w-[1280px] h-[700px] m-auto overflow-hidden">
        <div class="max-w-[1200px] h-[650px] p-8 m-auto rounded-[15px] shadow-[0px_0px_25px_0px] shadow-[#0000000F] overflow-y-auto cust-scroll mt-8 relative">
            <div id="sub-tab-nav-1" class="w-full h-auto flex items-center justify-start">
                <button data-tab-link="selected" class="sub-tab-1 flex items-center justify-center font-open-sans font-semibol text-base text-ac mr-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Назад</span>
                </button>
                <div class="w-full h-[50px] relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute right-[12px] top-[50%] translate-y-[-50%] text-mgc" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input id="search" type="text" class="w-full h-full pl-3 focus:outline-none border-b-[1px] border-b-ac focus:border-b-2" placeholder="Ведити не менее 2-х букв для начала поиска">
                </div>
            </div>
            <div id="load-words" class="w-full h-auto p-3 hidden">
                <span class="font-rubic font-semibold text-base text-mdc">Идет поиск...</span>
            </div>
            <div id="result-words" class="w-full h-auto p-3">

            </div>

            <div id="all-result-words" class="w-full h-auto p-3">

                <?php foreach ( $modelWordsAll as $item ) : ?>

                    <div class="w-full h-[40px] flex items-center justify-start">
                        <div class="h-auto font-rubic font-normal text-base text-mdc uppercase mr-3">
                            <?= $item['word_en'] ?>
                        </div>
                        <div class="h-auto font-rubic font-normal text-base text-mdc uppercase mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                        <div class="h-auto font-rubic font-normal text-base text-mdc uppercase mr-3">
                            <?= $item['word_ru'] ?>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>

<div data-tab="load-file" class="tab w-full h-full relative duration-200 ease-in-out translate-y-[150%] hidden">
    <div class="container xl:max-w-[1280px] h-auto m-auto overflow-hidden">
        <div class="max-w-[500px] h-auto p-8 m-auto rounded-[15px] shadow-[0px_0px_25px_0px] shadow-[#0000000F] overflow-y-auto cust-scroll mt-8 relative">
            <div id="load-file-csv-preload" class="absolute top-0 right-0 bottom-0 left-0 backdrop-blur-md flex items-center justify-center hidden" style="z-index: 90">
                <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
            <h2 class="font-rubic font-semibold text-mdc text-3xl uppercase">Загрузка словаря</h2>
            <br>
            <style>
                .form-group{
                    position: relative;
                }
                .help-block{
                    position: absolute;
                    top: 0px;
                    right: 0;
                    font-size: 10px;
                    color: red;
                }
            </style>
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'import_words_form w-full h-auto',
                    'id' => 'import_words_form'
                ]
            ]); ?>
                <?= $form->field($modelDictionaries, 'name')->textInput([
                    'class' => 'w-full h-[50px] font-open-sans font-medium text-mdc text-2xl px-5 mb-8 border-b-[1px] border-b-solid border-b-mdc focus:outline-none',
                    'placeholder' => 'Наименование словаря',
                    'id' => 'import_name_words'
                ])->label(false) ?>
                <?= $form->field($modelImport, 'fileImport')->fileInput([
                    'class' => 'import_file_words',
                    'id' => 'import_file_words'
                ])->label(false); ?>
                <button type="submit" class="mt-8 w-full h-[50px] bg-mc font-open-sans font-semibold text-white uppercase rounded-[50px] hover:ring-2 hover:ring-mc hover:ring-offset-2 hover:ring-offset-white duration-300 ease-in-out">Загрузить файл</button>
            <?php $form = ActiveForm::end(); ?>
        </div>
        <div class="max-w-[500px] h-auto p-8 m-auto rounded-[15px] shadow-[0px_0px_25px_0px] shadow-[#0000000F] overflow-y-auto cust-scroll mt-8 relative">
            <div id="load-file-zip-preload" class="absolute top-0 right-0 bottom-0 left-0 backdrop-blur-md flex items-center justify-center hidden" style="z-index: 90">
                <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
            <h2 class="font-rubic font-semibold text-mdc text-3xl uppercase">Загрузка изображений</h2>
            <br>
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'import_zip_form w-full h-auto',
                    'id' => 'import_zip_form'
                ]
            ]); ?>
            <?= $form->field($modelImportZip, 'fileImportZip')->fileInput([
                'class' => 'import_file_zip',
                'id' => 'import_file_zip'
            ])->label(false); ?>
            <button type="submit" class="mt-8 w-full h-[50px] bg-mc font-open-sans font-semibold text-white uppercase rounded-[50px] hover:ring-2 hover:ring-mc hover:ring-offset-2 hover:ring-offset-white duration-300 ease-in-out">Загрузить файл</button>
            <?php $form = ActiveForm::end(); ?>
        </div>
    </div>
</div>