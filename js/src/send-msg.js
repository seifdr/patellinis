
jQuery(document).ready( function($) {

	$("#emailUs").click(function () {
		$('div#contactUsModal div.modal-body').html('<form><div class="form-group"><label for="message-text" class="control-label">Message:</label><textarea class="form-control" id="message-text"></textarea></div></form>');
		$('button#sendMsg').show();
		$('#contactUsModal').modal('show');
		return false;
	});

	$(".dismissMe").click( function (){
		$('div#contactUsModal').modal('hide');
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
					success: function( data, textStatus, jqXHR ) {
						// alert(jqXHR.responseText);
						if( jqXHR.responseText == 1 ){
							$('button#sendMsg').prop("disabled",false).text("Send message").hide();
							
							msgText.val('');
							$('div#contactUsModal h4.modal-title').html("Success");
							$('div#contactUsModal div.modal-body').html("<div class='alert alert-success'><strong>Your message was successfully sent. We will be intouch shortly.</strong></div>");
							//$('div#contactUsModal').modal('hide');
						} else {
							alert('There was an error sending your message. Please try again.');
						}
					}
				});
		} else {
			alert('Please enter a message.');
		}
	});
});