var today = new Date();

var time_date = document.querySelector("#now_date");
// console.log(time_date.textContent);
time_date.textContent = today.toLocaleDateString();

var time_sec = document.querySelector("#now_time");
time_sec.textContent = today.toLocaleTimeString();

var time_flash = setInterval(new_time, 1000);
function new_time() {
    var new_time_sec = new Date();
    var time_sec_new = document.querySelector("#now_time");
    time_sec_new.textContent = new_time_sec.toLocaleTimeString();
}

$(function(){
    $("#gotop").click(function(){
        jQuery("html,body").animate({
            scrollTop:0
        },500);
    });
    $(window).scroll(function() {
        if ( $(this).scrollTop() > 300){
            $('#gotop').fadeIn("fast");
        } else {
            $('#gotop').stop().fadeOut("fast");
        }
    });
});