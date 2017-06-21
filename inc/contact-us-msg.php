<?php

class PatellinisContactUs
{

    function __construct(){
        add_action('wp_enqueue_scripts', array( $this, 'pcs_enqueue_scripts'), 12 );
        
        add_action( 'wp_ajax_nopriv_sendMsg', array( $this, 'sendMsg' ) );
        add_action( 'wp_ajax_sendMsg', array( $this, 'sendMsg' ) );
    }

    public function pcs_enqueue_scripts() {
        //wp_enqueue_script( 'send-msg', get_stylesheet_directory_uri() . "/js/send-msg.js", array('jquery'), '1.0', true );

        wp_localize_script( 'patelinnis_main_js', 'postmsg', array(
        	'ajax_url' => admin_url( 'admin-ajax.php' )
        ));
    }

    public function sendMsg() {
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        	
			if( isset( $_POST['message'] ) && !empty( $_POST['message'] ) ){
				$from = "Patellinis Website";

	            $xheaders = "";
	            $xheaders .= "From: <$from>\n";
	            $xheaders .= "X-Sender: <$from>\n";
	            $xheaders .= "X-Mailer: PHP\n"; // mailer
	            $xheaders .= "X-Priority: 3\n"; //1 Urgent Message, 3 Normal
	            $xheaders .= "Content-Type:text/html; charset=\"iso-8859-1\"\n";
	            $xheaders .= "Bcc:drs724@gmail.com\n";
	            // $xheaders .= "Cc:email2@example.com\n";
	
	            mail( 'duncan.seif@hotmail.com', "Message from the website", $_POST['message'], $xheaders );
	
	            echo TRUE; 
	            exit();
			} // isset and !empty $_POST['message']
				echo FALSE;
				exit();
        } else {
            die();
        }
    }
}

$patContact = new PatellinisContactUs();

?>