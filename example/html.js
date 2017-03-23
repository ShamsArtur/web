/**
 * Created by artur on 19.03.2017.
 */
$(document).ready(function () {
    $('form').hide();
    $('.groupName').click(function () {
        //if($(this).next("form".is(":visible")))
        if (!$(this).next("form").is(":visible")) {
            $(this).css({"color": "red", "font-size": "40px"});
        }
        else {
            $(this).css({"color": "white", "font-size": "25px"})
        }
        $(this).next("form").toggle();

    });

});