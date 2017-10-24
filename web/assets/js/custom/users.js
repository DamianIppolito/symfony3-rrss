$(document).ready(function(){
    var ias = jQuery.ias({
        container: '.box-users',
        item: '.user-item',
        pagination: '.pagination',
        next: '.pagination .next_link',
        triggerpageThreshold: 1
    });

    ias.extension(new IASTriggerExtension({
        text: 'Ver más personas',
        offset: 2
    }));

    ias.extension(new IASSpinnerExtension({
        src: URL + '/../assets/images/ajax-loader.gif'
    }));

    ias.extension(new IASNoneLeftExtension({
        text: 'No hay más personas'
    }));
});