$(document).ready(function () {
    $(function(){
        var current_page_URL = location.href;

        $( "a" ).each(function() {

            if ($(this).attr("href") !== "#") {

                var target_URL = $(this).prop("href");

                if (target_URL == current_page_URL) {
                    $('nav a').parents('li, ul').removeClass('active');
                    $(this).parent('li').addClass('active');

                    return false;
                }
            }
        });
    });

    $("#translation-form").submit(function (event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "/index/translate",
            data: {
                word: $("input#word").val()
            }
        })
            .done(function(response) {
                var data = JSON.parse(response);
                $("div#translation").html(
                    "<h3>Результат:</h3>" +
                    "<p class='request_word' >" + data.word +
                    ((data.speech_part) ? "<span class='speech_part'  > (" + data.speech_part + ")</span>" : "") + "</p>" +
                    "<p class='response_word'>" + data.translation +
                    ((data.transcription) ? " [" + data.transcription + "]" : "") + "</p>"
                );

            });
    });
});

$( "#translation-from" ).change(function() {
    setTranslationDirection();
});

$( "#translation-to" ).change(function() {
    setTranslationDirection();
});

function setTranslationDirection() {
    $.ajax({
        method: "POST",
        url: "/index/translate-direction",
        data: {
            from: $("select#translation-from option:checked").attr("id"),
            to:   $("select#translation-to   option:checked").attr("id")
        }
    })
        .done(function( msg ) {
        });
}

$('#word')
    .autocomplete({
        minLength: 0,
        source: function (request, response) {
                    $.ajax({
                        method: "POST",
                        url: "/index/get-autocomplete-variants",
                        data: {
                            language: $("select#translation-from option:checked").attr("id"),
                            letters: $("#word").val()
                        },
                        success: function (data) {
                            response(JSON.parse(data));
                        }
                    });
                }
    });