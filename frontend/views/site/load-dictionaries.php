<h2 class="font-rubic font-semibold text-mdc text-3xl uppercase">Доступные словари</h2>
<br>

<?php
$count_modelDictionariesRead = count( $modelDictionariesRead );
$iteration = 1;
?>

<?php foreach ( $modelDictionariesRead as $item ) : ?>

    <div class="w-full h-[50px] flex items-center justify-start">
        <a data-dictionaries-id="<?= $item['id'] ?>" id="dictionary-selected" class="dictionary-selected font-open-sans font-semibold text-center text-mdc text-base cursor-pointer duration-300 ease-in-out hover:text-mc flex items-center justify-start">
            <span style="margin-right: 10px;"><?= $item['name'] ?></span>
        </a>
    </div>

    <?php if ( $count_modelDictionariesRead != $iteration ) : ?>
        <hr>
    <?php endif; $iteration++; ?>

<?php endforeach; ?>

<div id="sub-tab-nav" class="h-[50px] absolute right-0 bottom-0 left-0 flex items-stretch justify-between">
    <button data-tab-link="selected-words" class="sub-tab block w-full bg-ac text-center font-open-sans font-semibold text-base text-white cursor-pointer hover:opacity-70 duration-300 ease-in-out" >Все слова</button>
</div>