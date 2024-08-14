<?php
 if(!isset($_POST)){
     die('No autorizado');
 }

 function json_output($status=200, $msg ='OK', $data=[]){
     echo json_encode(['status'=> $status, 'msg' => $msg, 'data'=> $data]);
     die;
 }
 if(empty($_POST['nombre'])){
     json_output(400, 'Ingresa un Nombre Valido');
 }
 if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    json_output(400, 'Ingresa un Email Valido');
 }
 if(empty($_POST['tel'])){
    json_output(400, 'Ingresa un Telefono Valido');
 }
 if(empty($_POST['mensaje']) || strlen($_POST['mensaje'])<5) {
    json_output(400, 'Ingresa un Mensaje Valido');
 }


 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 require 'Mailer/src/Exception.php';
 require 'Mailer/src/PHPMailer.php';
 require 'Mailer/src/SMTP.php';
 
 $mail = new PHPMailer(true);
 try {
 
 
     $bodyName = $_POST["nombre"];
     $bodyEmail = $_POST["email"];
     $bodyPhone = $_POST["tel"];
     $bodyMessage = $_POST["mensaje"];
 
     $mail->SMTPDebug = 0; 
     $mail->isSMTP();                                            //Send using SMTP
     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
     $mail->Username   = 'reportes.petrothor@gmail.com';                     //SMTP username
     $mail->Password   = 'Sys4Log$$sa';                               //SMTP password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
     $mail->SMTPSecure = 'tls';
     $mail->Port = 587;                                   //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
     $mail->CharSet = 'UTF-8';
                              
     //Recipients
     // $mail->setFrom('clientes@grupothor.com', 'GRUPO THOR');
 
     $mail->addAddress('player.b.96@hotmail.com');
     $mail->addAddress('player.b.1996@gmail.com');
     // $mail->addAddress('abrhm972@gmail.com');
 
 
 
 
 
     //Content
     $mail->isHTML(true);                                  //Set email format to HTML
     $mail->Subject = 'Web Sysnet ASUNTO';
     //$mail->AddEmbeddedImage('<img src="../../public/images/petrothor1.png">', 'my-attach', '<img src="../../public/images/petrothor1.png">');
     $mail->Body    = 
     '<b>Nombres y Apellidos:</b> '. $bodyName  . '<br>
     <b>Telefono:</b> ' . $bodyPhone . '<br>
     <b>Correo:</b> ' . $bodyEmail . '<br>
     <b>Comentario:</b> ' . $bodyMessage . '<br>';
 
     //$mail->addStringAttachment($document, 'petrothor.pdf', 'base64', 'application/pdf');
  
     
 
     $mail->send();
         echo "<p>mensaje enviado</p>";       
     } 
 
    
     catch (Exception $e) {
         echo "<p>mensaje no enviado</p>";
     }
   


?>