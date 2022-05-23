//GLOBAL VAR
let doc = $(document);
let header = $('header');
let main = $('main');
let current__count = 0;
let position_scroll = 0;
let current_tab = 1;
let green__msg = $('footer[role="green"]');
let red__msg = $('footer[role="red"]');



//Switch a tabs
let app_switch_tabs = (function() {

    function switching_tabs(_this){
        $('#nav .nav__item').removeClass('bg-white text-mc text-white bg-mc').addClass('text-white bg-mc');
        _this.removeClass('bg-mc text-white').addClass('bg-white text-mc');
        let data_tab_link = _this.attr('data-tab-link');
        $('.tab').addClass('translate-y-[150%]');
        setTimeout(() => {
            $('.tab').addClass('hidden');
            $('div[data-tab="'+data_tab_link+'"]').removeClass('hidden');
            setTimeout(() => {
                $('div[data-tab="'+data_tab_link+'"]').removeClass('translate-y-[150%]');
            }, 100);
        }, 100);
        if ( data_tab_link === "education" )
        {
            $('#lang').removeClass('hidden');
        }
        else
        {
            $('#lang').addClass('hidden');
        }
    }

    function init( ){
        $('#nav').on('click', '.nav__item', function() {
            let _this = $(this);
            switching_tabs(_this);
        });
    }

    return {
        init: init
    }

})()



let app_switch_tabs_lev2 = (function() {

    function switching_tabs_lev2(_this){
        let data_tab_link = _this.attr('data-tab-link');
        $('.tab').addClass('translate-y-[150%]');
        setTimeout(() => {
            $('.tab').addClass('hidden');
            $('div[data-tab="'+data_tab_link+'"]').removeClass('hidden');
            setTimeout(() => {
                $('div[data-tab="'+data_tab_link+'"]').removeClass('translate-y-[150%]');
            }, 100);
        }, 100);
    }

    function init( ){
        main.on('click', '.sub-tab', function() {
            let _this = $(this);
            switching_tabs_lev2(_this);
        });

        $('#sub-tab-nav-1').on('click', '.sub-tab-1', function() {
            let _this = $(this);
            $('#result-words').html("");
            $('#search').val("");
            $('#all-result-words').removeClass('hidden');
            switching_tabs_lev2(_this);
        });
    }

    return {
        init: init
    }

})()



//Switch a lang
let app_switch_lang = (function (){

    function switching_lang(){
        let left__flag = $('#flag_left > *');
        let right__flag = $('#flag_right > *');
        $('#flag_left').append(right__flag);
        $('#flag_right').append(left__flag);

        let app_switch_lang_cards = (function (){

            function get_switch_lang_cards(){
                let cards = $('.word-slide__item');
                console.log('card: '+cards);
                let count_cards = cards.length;
                console.log('card_count: '+count_cards);

                for ( let i = 1; i <= count_cards; i++ ){
                    let view_txt = $('h3[data-scroll-tab="main-text-'+i+'"]');
                    let hidden_txt = $('h3[data-scroll-tab="text-'+i+'"]');
                    let view_text = view_txt.text();
                    let hidden_text = hidden_txt.text();
                    let buff = view_text;
                    view_txt.text(hidden_text);
                    hidden_txt.text(buff);
                }
            }

            function init(){
                get_switch_lang_cards();
            }

            return {
                init: init
            }

        })()

        doc.ready(app_switch_lang_cards.init);
    }

    function switching_lang_hover( flag_arrow_hover, flag_arrow_not_hover ){
        flag_arrow_not_hover.css({ transform: 'translateY(-100%)' });
        flag_arrow_hover.css({ transform: 'translateY(-50%)' });
    }

    function switching_lang_not_hover( flag_arrow_hover, flag_arrow_not_hover ){
        flag_arrow_not_hover.css({ transform: 'translateY(50%)' });
        flag_arrow_hover.css({ transform: 'translateY(100%)' });
    }

    function init(){
        header.on('click', '#lang', switching_lang);
        header.on('mouseover', '#lang', function (){
            let flag_arrow_not_hover = $('.arrow');
            let flag_arrow_hover = $('.arrow-hover');
            switching_lang_hover( flag_arrow_hover, flag_arrow_not_hover );
        });
        header.on('mouseout', '#lang', function(){
            let flag_arrow_not_hover = $('.arrow');
            let flag_arrow_hover = $('.arrow-hover');
            switching_lang_not_hover( flag_arrow_hover, flag_arrow_not_hover );
        });
    }

    return {
        init: init
    }

})()



//Scroll function for a main slider
let app_scroll_slider = (function (){

    function scroll_slider( slide_word__case, slide_word__items, count__slide_word__items, btn_translate ){
        if ( current__count < count__slide_word__items - 1 )
        {
            position_scroll = position_scroll + 592;
            slide_word__case.css({
                transform: 'translateY(-'+position_scroll+'px)'
            });
            current_tab++;
            btn_translate.attr('data-current-scroll-id', current_tab);
            current__count++;
        } else{
            slide_word__case.css({
                transform: 'translateY(0px)'
            });
            current__count = 0;
            position_scroll = 0;
            current_tab = 1;
            for ( let i = 1; i <= count__slide_word__items; i++ )
            {
                $('h3[data-scroll-tab="mask-'+i+'"]').removeClass('hidden');
                $('h3[data-scroll-tab="text-'+i+'"]').addClass('hidden');
            }
            btn_translate.attr('data-current-scroll-id', current_tab);
        }
    }

    function init(){
        main.on('click', '.next-word', function (){
            let slide_word__case = $('main #word-slide');
            let slide_word__items = $('main #word-slide__item');
            let count__slide_word__items = slide_word__items.length;
            let btn_translate = $('.translate');
            scroll_slider( slide_word__case, slide_word__items, count__slide_word__items, btn_translate )
        });

    }

    return {
        init: init
    }

})()



//View translate text for current slide
let app_view_translate = (function (){

    function get_view_translate( _this ){
        let current_slaide = _this.attr('data-current-scroll-id');
        $('h3[data-scroll-tab="mask-'+current_slaide+'"]').addClass('hidden');
        $('h3[data-scroll-tab="text-'+current_slaide+'"]').removeClass('hidden');
    }

    function init(){
        main.on('click', '.translate', function() {
            let _this = $(this);
            get_view_translate( _this );
        });
    }

    return {
        init: init
    }

})()



let app_selected_dictionaries = (function (){

    function get_selected_dictionaries( _this ){
        let dict_id = _this.attr('data-dictionaries-id');
        let dict_name = _this.text();
        $.ajax({
            type: 'post',
            url: '/frontend/web/index.php/site/reload-cards',
            dataType: 'html',
            data: {
                '_dict_id': dict_id
            },
            beforeSend: function () {
                $('.tab').addClass('translate-y-[150%]');
                setTimeout(() => {
                    $('.tab').addClass('hidden');
                    $('.tab[data-tab="education"]').removeClass('hidden');
                    setTimeout(() => {
                        $('.tab[data-tab="education"]').removeClass('translate-y-[150%]');
                    }, 100);
                }, 100);
                $('#lang').removeClass('hidden');
                $('#nav .nav__item').removeClass('bg-white text-mc text-white bg-mc').addClass('text-white bg-mc');
                $('a[data-tab-link="education"]').removeClass('bg-mc text-white').addClass('bg-white text-mc');
                $('#load-education-preload').removeClass('hidden');
                $('#education_cards').html("");
            },
            success: function ( response ) {
                green__msg.css({
                    transform: 'translateY(100%)'
                });
                $('#load-education-preload').addClass('hidden');
                $('#education_cards').append( response );
                $('main .dictionary-selected span').removeClass('text-ac');
                _this.html('<span class="text-ac" style="margin-right: 10px;">'+dict_name+'</span>\n');
                $('footer[role="green"] h6').text('Установлен словарь: '+ dict_name);
                green__msg.css({
                    transform: 'translateY(0px)'
                });
                setTimeout(() => {
                    green__msg.css({
                        transform: 'translateY(100%)'
                    });
                }, 3000);
            }
        });

        $.ajax({
            type: 'post',
            url: '/frontend/web/index.php/site/reload-lang',
            dataType: 'html',
            success: function ( response ) {
                let lang = $('#lang');
                lang.html("");
                lang.append( response );
            }
        });
    }

    function init(){
        main.on('click', '#dictionary-selected', function () {
            current__count = 0;
            position_scroll = 0;
            current_tab = 1;
            let _this = $(this);
            console.log(_this);
            get_selected_dictionaries( _this );
        });
    }

    return {
        init: init
    }

})()



let app_search_word = (function (){

    function get_search_word( _this ){
        let value_search = _this.val();
        $.ajax({
            type: 'post',
            url: '/frontend/web/index.php/site/search-words',
            dataType: 'html',
            data: {
                '_value_search': value_search
            },
            beforeSend: function () {
                $('#load-words').removeClass('hidden');
                $('#result-words').html("");
            },
            success: function ( response ) {
                $('#load-words').addClass('hidden');
                $('#result-words').html( response );
            }
        });

    }

    function init(){
        $('#search').on('keyup input', function (){
            let _this = $(this);
            let count = _this.val().length;
            if ( count > 2 ){
                $('#all-result-words').addClass('hidden');
                get_search_word( _this );
            }
            if ( count === 0 ){
                $('#all-result-words').removeClass('hidden');
                $('#result-words').html("");
            }
        });
    }

    return {
        init: init
    }

})()




//START APPS
doc.ready(app_switch_tabs.init);
doc.ready(app_switch_tabs_lev2.init);
doc.ready(app_switch_lang.init);
doc.ready(app_scroll_slider.init);
doc.ready(app_view_translate.init);
doc.ready(app_selected_dictionaries.init);
doc.ready(app_search_word.init);