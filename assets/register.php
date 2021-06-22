<?php
//    if(isset($_FILES['image'])){
//       $errors= array();
//       $file_name = $_FILES['image']['name'];
//       $file_size = $_FILES['image']['size'];
//       $file_tmp = $_FILES['image']['tmp_name'];
//       $file_type = $_FILES['image']['type'];
//       $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
//       $expensions= array("jpeg","jpg","png","pdf");
      
//       if(in_array($file_ext,$expensions)=== false){
//          $errors[]="extension not allowed, please choose a PDF, JPEG or PNG file.";
//       }
      
//       if($file_size > 2097152) {
//          $errors[]='File size must be excately 2 MB';
//       }
      
//       if(empty($errors)==true) {
//          move_uploaded_file($file_tmp,"uploads/".$file_name); //The folder where you would like your file to be saved
//          echo "Success";
//       }else{
//          print_r($errors);
//       }
//    }

// PHPMailer script below
$fname = $_REQUEST['fname'] ;
$lname = $_REQUEST['lname'] ;
$email = $_REQUEST['email'] ;
$select = $_REQUEST['select'] ;
$phone = $_REQUEST['phone'] ;
$father = $_REQUEST['father'];
$mother = $_REQUEST['mother'];
$address = $_REQUEST['address'];
$district = $_REQUEST['district'];
$state = $_REQUEST['state'];
$selectTwo = $_REQUEST['selectTwo'];


$phone = $_REQUEST['phone'] ;
$message = $_REQUEST['message'] ;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';

$mail = new PHPMailer();

$mail->IsSMTP();


$mail->SMTPAuth = true; 
$mail->addAttachment("uploads/".$file_name);
$mail->From = $email;
$mail->addAddress("vijay@brownbutton.io", "@admin");
$mail->Subject = "You have an email from a website visitor!";
$mail->Body ="
Name: $name<br>
Email: $email<br>
Telephone: $phone<br><br><br>
Comments: $message";
$mail->AltBody = $message;

if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}