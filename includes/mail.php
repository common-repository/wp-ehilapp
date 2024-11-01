<?php

// email per pubblicazione
function ehilapp_send_mail_on_new_post( $post_id, $post  ) {
    if ( strpos($_SERVER['HTTP_REFERER'], 'edit-question') !== false ) {
        // altro...
    } else {

			$headers = '';
			$to = 'control@ehilapp.com';
			$subject = get_site_url();
			$post_title = $post->post_title;
			$message = 'Ehilapp: ' . $post_title;
			
			wp_mail($to, $subject, $message, $headers);
			
		}
}
add_action( 'publish_post', 'ehilapp_send_mail_on_new_post', 10, 3 );

// fine


?>