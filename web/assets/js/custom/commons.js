$(document).ready(function () {
    notifications();
    setInterval(function () {notifications()},60000);
});

function notifications() {
    $.ajax({
        url: URL + '/notifications/get',
        type: 'GET',
        success: function (response) {
            $('.label-notifications').html(response);
            show_or_hide_notifications();
        }
    });
}

function show_or_hide_notifications() {
    if($('.label-notifications').text() == 0){
        $('.label-notifications').addClass('hidden');
    }else{
        $('.label-notifications').removeClass('hidden');
    }
}