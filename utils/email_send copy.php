<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';


function inc_envia_email($to,$name){


    $de_EstruturaEmail = '
  <h2>Este é um e-mail enviado por ' . utf8_decode($name) . ' pela intranet </h2>

  <table>
    <tr style="float: left;">
      <div style="display: flex">
        <th><img src="https://bywilliams.github.io/site/assets/img/logos/logo1.png"></img></th>
        <th style="font-size: 2rem;">Finance Control - Seu dinheiro seguro!</th>
      </div>
    </tr>

  </table>
  <br> ';

    //Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();


    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';


    //Set the SMTP port number:
    // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
    // - 587 for SMTP+STARTTLS
    $mail->Port = 465;

    //Set the encryption mechanism to use:
    // - SMTPS (implicit TLS on port 465) or
    // - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = "ssl";

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'financecontro997@gmail.com';

    //Password to use for SMTP authentication
    $mail->Password = 'zugxxraapkwliehe';

    $mail->Debugoutput = 'html';


    $mail->setFrom('financecontro997@gmail.com', 'Finance Control');

    //Set an alternative reply-to address
    //This is a good place to put user-submitted addresses
    $mail->addReplyTo('noreply@gmail.com', 'Robot');

    //Set who the message is to be sent to
    $mail->addAddress('willian.seu@gmail.com', 'Kyorazo');

    //Set the subject line
    $mail->Subject = "Finance Control - Recuperação de senha.";

    $mail->msgHTML($de_EstruturaEmail);
    // $mail->Body =
    // $mail->msgHTML($de_EstruturaEmail);
    $mail->AltBody = 'This is a plain-text message body';

    //Attach an image file
    // $mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
   
      if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        echo "<script>
          alert('E-mail enviado com sucesso!');
          </script>";
        header('location: index.php');
      }
   

}
?>