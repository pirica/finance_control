<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_email($to,$name, $password) {

    $mail = new PHPMailer(true);

    try {
    
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP(); 
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true; 
      $mail->Username = 'youraccount@gmail.com'; 
      $mail->Password = 'your_gmail_app_key'; //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
      $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('youraccount@gmail.com', 'Finance Control');
      $mail->addAddress($to); //Add a recipient
      $mail->addCC('willian.seu@gmail.com'); // Copy
      
      $mail->addReplyTo('noreply@gmail.com', 'Robot');

      $body = '    
      <table>
      <thead> 
      <tr style="float: left;">
        <div style="display: flex">
          <th scope="col">
         
          <img width="20%" src="https://github.com/bywilliams/finance_control/blob/main/assets/finance_logo.png?raw=true"></img>
          </th>
          <th scope="col" style="font-size: 1.5rem;">Finance Control <br> Seu dinheiro seguro!</th>
        </div>
      </tr>
      </thead>    
      </table>
      <br> 
      <div style="margin: 30px">
      <h3>
        	  Ola <span style="color: red">'.utf8_decode($name).'</span> siga as instruções abaixo para recuperar sua senha. </h3><br>
            <p>   Entre com o mesmo endereço de e-mail e a senha a seguir: <span style="color: red">'.$password.' </span>
            <br>
            Faça login utilizando a senha informada, depois vá em editar perfil e coloque uma nova senha.
            <br>
            Qualquer dúvida envie um e-mail para financecontrol997@gmail.com e iremos te ajudar!  <br>
            Equipe Finance Control    
            </p>
      </div>
      ';

      //Content
      $mail->isHTML(true); //Set email format to HTML
      $mail->msgHTML($body);
      $mail->Subject = utf8_decode('Recuperação de senha de '.$name);

      $mail->Body = $body;
      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      //echo 'Mensagem enviada com sucesso!';
    } catch (Exception $e) {
      echo "Mensagem não pode ser enviada: {$mail->ErrorInfo}";
    }
 
  
}

?>