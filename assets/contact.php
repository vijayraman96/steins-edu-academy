
<?php

// Class
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Validate
if ( isset( $_POST[ 'email' ] ) || array_key_exists( 'email', $_POST ) ) :

	// Message Settings
	$message = array(
		'fname'			=> $_POST[ 'fname' ],
		'lname'			=> $_POST[ 'lname' ],
		'email'		    => $_POST[ 'email' ],
		'select'		=> $_POST[ 'select' ],
		'phone'		=> $_POST[ 'phone' ],
		'father'	=> $_POST[ 'father' ],
		'mother'	=> $_POST[ 'mother' ],
		'address'	=> $_POST[ 'address' ],
		'district'	=> $_POST[ 'district' ],
		'state'		=> $_POST[ 'state' ],
		'selectTwo'		=> $_POST[ 'selectTwo' ],
		'body'			=> '',
		"alerts"		=> array(
			"error"			=> 'Message could not be sent.',
			"success"		=> 'Thank you. Your request has been received. We will get back to you soon',
		),
	);
	
	$message[ 'body' ] .= '<b>First Name:</b> ' . $message[ 'fname' ];
	$message[ 'body' ] .= '<b>Last Name:</b> ' . $message[ 'lname' ];
	$message[ 'body' ] .= '<br><b>Email:</b> ' . $message[ 'email' ];
	$message[ 'body' ] .= '<br><b>Gender:</b> ' . $message[ 'select' ];
	$message[ 'body' ] .= '<br><b>Number:</b> ' . $message[ 'phone' ];
	$message[ 'body' ] .= '<br><b>Father Name</b> ' . $message[ 'father' ];
	$message[ 'body' ] .= '<br><b>Mother Name</b> ' . $message[ 'mother' ];
	$message[ 'body' ] .= '<br><b>Address:</b> ' . $message[ 'address' ];
	$message[ 'body' ] .= '<br><br><b>District:</b><br>' . $message[ 'district' ];
	$message[ 'body' ] .= '<br><br><b>State:</b><br>' . $message[ 'state' ];
	
	// Include
	require 'phpmailer/Exception.php';
	require 'phpmailer/PHPMailer.php';

	$mail = new PHPMailer( true );

	try {
		// Recipients
		$mail->AddReplyTo( $message[ 'email' ], $message[ 'name' ] );
		$mail->setFrom( 'admin@'. $_SERVER['SERVER_NAME'], $message[ 'name' ] );
		$mail->addAddress( $settings[ 'email' ], $settings[ 'name' ] );
		
		// Content
		$mail->isHTML( true );
		// $mail->Subject = $message[ 'subject' ];
		$mail->Body    = $message[ 'body' ];
		
		// Send
		$mail->send();
		
		// Success
		echo '["success", "'. $message[ 'alerts' ][ 'success' ] .'"]';
	} catch ( Exception $e ) {
		// Error
		echo '["error", "'. $message[ 'alerts' ][ 'error' ] .'"]';
	}

endif;





