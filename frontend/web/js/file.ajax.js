//Import data on the CSV
let app_load_CSV = (function (){

    function get_ajax_csv(){
        let form = $('#import_words_form');
        let formData = new FormData(form[0]);
        $.ajax({
            type: 'post',
            url: '/site/index',
            data: formData,
            dataType : 'html',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#load-file-csv-preload').removeClass('hidden');
                $('footer[role="green"]').css({
                    transform: 'translateY(0px)'
                });
                $('footer[role="green"] h6').text('Идет загрузка...');
            },
            success: function( response ) {
                green__msg.css({
                    transform: 'translateY(100%)'
                });
                $('#load-file-csv-preload').addClass('hidden');
                $('footer[role="green"] h6').text(response);
                green__msg.css({
                    transform: 'translateY(0px)'
                });
                $('#import_name_words').val('');
                setTimeout(() => {
                    green__msg.css({
                        transform: 'translateY(100%)'
                    });
                }, 3000);

                let app_load_dictionaries = (function(){

                    function get_load_dictionaries(){
                        $.ajax({
                            type: 'post',
                            url: '/frontend/web/index.php/site/load-dictionaries',
                            dataType: 'html',
                            beforeSend: function () {
                                $('#load-dictionaries-preload').removeClass('hidden');
                                $('#all-dictionaries').html("");
                            },
                            success: function ( response ) {
                                $('#load-dictionaries-preload').addClass('hidden');
                                $('#all-dictionaries').append( response );
                            }
                        });
                    }

                    function init(){
                        get_load_dictionaries();
                    }

                    return {
                        init: init
                    }

                })()

                doc.ready(app_load_dictionaries.init);

                let app_reload_words = (function (){

                    function get_reload_words(){
                        $.ajax({
                            type: 'post',
                            url: '/frontend/web/index.php/site/search-words-all-view',
                            dataType: 'html',
                            beforeSend: function () {
                                $('#all-result-words').html("");
                            },
                            success: function ( response ) {
                                $('#all-result-words').html( response );
                            }
                        });
                    }

                    function init(){
                        get_reload_words();
                    }

                    return {
                        init: init
                    }

                })();

                doc.ready(app_reload_words.init);
            },
            error: function () {
                $('footer[role="red"] h6').text('Произошла ошибка!');
                $('#load-file-csv-preload').addClass('hidden');
                green__msg.css({
                    transform: 'translateY(100%)'
                });
                red__msg.css({
                    transform: 'translateY(0px)'
                });
                setTimeout(() => {
                    red__msg.css({
                        transform: 'translateY(100%)'
                    });
                }, 2000);
            }
        });
    }

    function init(){
        $('.import_words_form').on('beforeSubmit', function ( event ){
            event.preventDefault();
            get_ajax_csv();
            return false;
        });
    }

    return{
        init: init
    }

})()



//Load data on the ZIP
let app_load_ZIP = (function (){

    function get_ajax_zip(){
        let form = $('#import_zip_form');
        let formData = new FormData(form[0]);
        $.ajax({
            type: 'post',
            url: '/site/index',
            data: formData,
            dataType : 'html',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#load-file-zip-preload').removeClass('hidden');
                $('footer[role="green"]').css({
                    transform: 'translateY(0px)'
                });
                $('footer[role="green"] h6').text('Идет загрузка...');
            },
            success: function( response ) {
                green__msg.css({
                    transform: 'translateY(100%)'
                });
                $('#load-file-zip-preload').addClass('hidden');
                $('footer[role="green"] h6').text(response);
                green__msg.css({
                    transform: 'translateY(0px)'
                });
                setTimeout(() => {
                    green__msg.css({
                        transform: 'translateY(100%)'
                    });
                }, 3000);
            },
            error: function () {
                $('footer[role="red"] h6').text('Произошла ошибка!');
                $('#load-file-zip-preload').addClass('hidden');
                green__msg.css({
                    transform: 'translateY(100%)'
                });
                red__msg.css({
                    transform: 'translateY(0px)'
                });
                setTimeout(() => {
                    red__msg.css({
                        transform: 'translateY(100%)'
                    });
                }, 2000);
            }
        });
    }

    function init(){
        $('.import_zip_form').on('beforeSubmit', function ( event ) {
            event.preventDefault();
            get_ajax_zip();
            return false;
        });
    }

    return{
        init: init
    }

})()




//START APPS
doc.ready(app_load_CSV.init);
doc.ready(app_load_ZIP.init);