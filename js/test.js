jQuery(document).ready(function($) {


				function arrayContains(needle, arrhaystack) {
				    return (arrhaystack.indexOf(needle) > -1);
				}

				hideAndShow( value ){

					alert("hello");

					// .reg
					// .soda 
					// .salad

					var text = value.toLowerCase();

					if( text == "fresh homemade pizza" ){
						$(".fhp").css("display", "block");
						
						$(".reg, .soda, .salad").css("display", "none");

					} else if( text == "fresh salads" ) {
						$(".salad").css("display", "block");

						$(".fhp, .soda, .reg").css("display", "none");

					} else if ( text == "beverage" ){

						$(".soda").css("display", "block");

						$(".fhp, .salad, .reg").css("display", "none");

					} else {
						$(".fhp, .soda, .salad").css("display", "none");
						$(".reg").css("display", "block");
					}
				}
			
				var initCatSelectVal = $("select#catselect").val();

				if( initCatSelectVal != "-- SELECT ONE --" ){
					hideAndShow( initCatSelectVal );
				}				

				$("select#catselect").change(
					function(){ 
						hideAndShow( $(this).val() );
					});

			});