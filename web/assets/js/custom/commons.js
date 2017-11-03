$(document).ready(function () {
    new_alerts();
    setInterval(function () {new_alerts()},60000);
});

function new_alerts() {
    $.ajax({
        url: URL + '/notifications/get',
        type: 'GET',
        success: function (response) {
            $('.label-notifications').html(response);
            show_or_hide_new_alerts('notifications');
        }
    });

    $.ajax({
        url: URL + '/private-message/notification/get',
        type: 'GET',
        success: function (response) {
            $('.label-private-messages').html(response);
            show_or_hide_new_alerts('private-messages');
        }
    });
}

function show_or_hide_new_alerts(type) {
    if(type == 'notifications'){
        if($('.label-notifications').text() == 0){
            $('.label-notifications').addClass('hidden');
        }else{
            $('.label-notifications').removeClass('hidden');
        }
    }else{
        if($('.label-private-messages').text() == 0){
            $('.label-private-messages').addClass('hidden');
        }else{
            $('.label-private-messages').removeClass('hidden');
        }
    }
}