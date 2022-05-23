<?php

use frontend\models\Words;

$modelWords = Words::find()->where(['or', ['like', 'word_en', $_value_search], ['like', 'word_ru', $_value_search]])->all();
$count = count( $modelWords );
?>
<?php foreach ( $modelWords as $item ) : ?>

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

<?php if ( $count == 0 ) : ?>
    <div class="w-full h-[40px] flex items-center justify-start">
        <div class="h-auto font-rubic font-normal text-base text-mdc uppercase mr-3">
            Ничего не найдено...
        </div>
    </div>
<?php endif; ?>
