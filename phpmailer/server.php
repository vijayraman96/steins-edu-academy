
<?php

// Class
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_FILES['fileOne'])){
      $errors= array();
      $file_name = $_FILES['fileOne']['name'];
      $file_size = $_FILES['fileOne']['size'];
      $file_tmp = $_FILES['fileOne']['tmp_name'];
      $file_type = $_FILES['fileOne']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['fileOne']['name'])));
      
      $expensions= array("jpeg","jpg","png","pdf");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a PDF, JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"uploads/".$file_name); //The folder where you would like your file to be saved
         echo "Success";
      }else{
         print_r($errors);
      }
   }

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
		'fileOne'		=> $_POST[ $_FILES['fileOne']['name'] ],
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
	$message[ 'body' ] .= '<br><br><b>Status:</b><br>' . $message[ 'selectTwo' ];
	$message[ 'body' ] .= '<br><br><b>10th marksheet:</b><br>' . $message[ 'fileOne' ];
	
	// Include
	require 'phpmailer/Exception.php';
	require 'phpmailer/PHPMailer.php';

	$mail = new PHPMailer( true );

	try {
		// Recipients
		$mail->AddReplyTo( $message[ 'email' ], $message[ 'name' ] );
		$mail->setFrom( 'admin@'. $_SERVER['SERVER_NAME'], $message[ 'name' ] );
		$mail->addAddress( $settings[ 'email' ], $settings[ 'name' ] );
		$mail->addAttachment("uploads/".$file_name);
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





