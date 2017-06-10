jQuery(document).ready(function($) {

	function ajaxOrderCats( catOrder, type ){

		jQuery.ajax({
			url : orderCats.ajax_url,
			type : 'post',
			data : {
				action : 'order_cats',
				type: type,
				catOrder : catOrder
			},
			success : function( response ) {
				//do nothing
			}
		});


	}



    $('#sortableCats').sortable({
       update: function(event, ui) {
          var catOrder = $(this).sortable('toArray');

          console.log( catOrder );

          ajaxOrderCats( catOrder, "category" );

          catOrder.toString();

       }
    });

	$( "#unsortedCats" ).sortable({
    	connectWith : "#sortableCats, #unsortedCats"
    });




    //sortable({
       // update: function(event, ui) {
       //    var catOrder = $(this).sortable('toArray');

       //    console.log( catOrder );

       //    ajaxOrderCats( catOrder );

       //    catOrder.toString();

       // }
   // });

 });
