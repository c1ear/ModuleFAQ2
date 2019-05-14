require(['jquery', 'jquery/ui'], function($){

    $(document).ready(function(){
        $('.row_faq .title').click(function(){
            $(this).parent('li').toggleClass("open");
        });
        $('.title-ask').click(function(e) {
            e.preventDefault();
            $(this).hide();
            $('.thanks-hide').show();
        });


    });

    $(document).on('keyup', '#ajax_form_mage textarea[name="tags"]', function(e) {
        var t = document.getElementById('tags').value;
        if (t.length > 5) {
            $(".sbmt").attr("disabled", false);
        } else {
            $(".sbmt").attr("disabled", true);
        }
    });


});