<div id="education_cards" class="container xl:max-w-[1280px] h-[600px] m-auto overflow-hidden">
    <div class="w-full h-full overflow-hidden">
        <div id="word-slide" class="w-full h-auto duration-300 ease-in-out">

            <?php $iteration_words = 1; ?>
            <?php foreach ( $modelWords as $item ) : ?>

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

            <?php $count_cards = count( $modelWords ); ?>
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
        <?php if ( isset( $modelDictionaries ) ) : ?>
            <h6 class="current-dictionary font-rubic font-medium text-sm text-mc text-center py-5">Текущий словарь: <?= $modelDictionaries['name'] ?></h6>
        <?php endif; ?>
    </div>
</div>