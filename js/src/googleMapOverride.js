// A script to disable map mouse events without first clicking on the map, then disabling it again on mouse leave

jQuery(document).ready(function($) {  
    $('.maps').click(function () {
        $('.maps iframe').css("pointer-events", "auto");
    });

    $( ".maps" ).mouseleave(function() {
        $('.maps iframe').css("pointer-events", "none"); 
    });
});