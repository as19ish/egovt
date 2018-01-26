<?php
function sendConfirmationEmail($email){
        $code = '88888';
        $subject = 'Confirm your registration';
        $message = 'Please confirm you registration by pasting this code in the confirmation box: '.$code;
        $headers = 'X-Mailer: PHP/' . phpversion();

        if(mail($email, $subject, $message, $headers)){
            return true;
        }else{
            return false;
        }
    }
    sendConfirmationEmail('as19ish@gmail.com');
?>
