


jQuery(document).ready( function($) {

	$("#emailUs").click(function () {
			$('#contactUsModal').modal('show');
			return false;
	});

	$('button#sendMsg').on('click', function(){

		var msgText = $('textarea#message-text');

			if( msgText.val().trim().length > 0 ){

				$('button#sendMsg').prop("disabled",true).text('Sending...');

				$.ajax({
					url: postmsg.ajax_url,
					type: 'post',
					data: {
						action: 'sendMsg',
						message: msgText.val()
					},
					success: function( response ) {
						
						var x = $.trim(response );

						alert( x );

						$('button#sendMsg').prop("disabled",false).text("Send message");

						if( x == 1 ){
							msgText.val() = '';
							alert( 'Your message was sucessfully sent.');
							$('div#contactUsModal').modal('hide');
						} else {
							alert('There was an error sending your message. Please try again.');
						}

						alert('hi');
					},
					timeout : function( ){
						alert( ' I timed out ');
					},
					error: function(  jqXHR, textStatus, errorThrow ){
						alert( 'textStatus: ' + textStatus );
						alert( 'errorThrow: ' . errorThrow );
					}
				});
		} else {
			alert('Please enter a message.');
		}


		

	});

});