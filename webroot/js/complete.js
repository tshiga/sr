
$(function() {
    console.log("start");

    $("#bt_line").click(function () {
        $("#line_modal").fadeIn(500);
        $('html, body').animate({ scrollTop: 0 }, 'fast');
    });
    $("#line_modal_close a").click(function () {
        $("#line_modal").fadeOut(500);
    });

});
