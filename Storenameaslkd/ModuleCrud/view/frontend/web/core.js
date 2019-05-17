require(['jquery', 'jquery/ui'], function($){







    $(document).ready(function(){

/*
        $('.sbmt').click(function(e){
            var t = document.getElementById('tags').value;
            if (t.length < 5) {
                e.preventDefault();
                $('.alert-form').hide();
                $('#tags').after('<div class="alert-form">Enter at least 5 characters</div>');

            } else {

            }
        });
*/


        $('.sbmt').click(function(e){
            var t = document.getElementById('tags').value;
            if (t.length > 5) {
                e.preventDefault();
                e.stopImmediatePropagation();
                $.ajax({
                    type: 'post',
                    url: '/crudmodule/index/save/',
                    data: $('#ajax_form_mage').serialize(),
                    cache: false,
                    showLoader: 'true',
                    success: function() {
                        $('#tags').val('');
                        alert('Thanks for question');

                    }
                });
                return false;
            } else {
                e.preventDefault();
                $('.alert-form').hide();
                $('#tags').after('<div class="alert-form">Enter at least 5 characters</div>');
            }

        });





        $('.row_faq .title').click(function(){
            $(this).parent('li').toggleClass("open");
        });
        $('.title-ask').click(function(e) {
            e.preventDefault();
            $(this).hide();
            $('.thanks-hide').show();
        });


    });

/*
    $(document).on('keyup', '#ajax_form_mage textarea[name="tags"]', function(e) {
        var t = document.getElementById('tags').value;
        if (t.length > 5) {
            $(".sbmt").attr("disabled", false);
        } else {
            $(".sbmt").attr("disabled", true);
        }
    });
 */
    $(document).on('keyup', '#ajax_form_mage textarea[name="tags"]', function() {
        $('.alert-form').hide();
    });




});