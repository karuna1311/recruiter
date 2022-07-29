<?php

namespace App\Services;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;

class emailService 
{
    public static function sendEmail($emailRecipient,$emailSubject,$emailBody)
    {
        return self::composeEmail(['emailRecipient'=>$emailRecipient,'emailSubject'=>$emailSubject,'emailBody'=>$emailBody]);
    }
    
    public static function composeEmail($request) {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        try {
            // Email server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = env('EMAIL_HOST');             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = env('EMAIL_USERNAME');   //  sender username
            $mail->Password = env('EMAIL_PASSWORD');       // sender password
            $mail->SMTPSecure = env('EMAIL_SMTP');                  // encryption - ssl/tls
            $mail->Port = env('EMAIL_PORT');                          // port - 587/465
            $mail->setFrom(env('EMAIL_SETFROM'));
            $mail->addAddress($request['emailRecipient']);
            //$mail->addCC($request->emailCc);
            //$mail->addBCC($request->emailBcc);
            //$mail->addReplyTo('sender@example.com', 'SenderReplyName');
            // if(isset($_FILES['emailAttachments'])) {
            //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
            //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
            //     }
            // }
            $mail->isHTML(true);                // Set email content format to HTML
            $mail->Subject = $request['emailSubject'];
            $mail->Body    = $request['emailBody'];
            // $mail->AltBody = plain text version of email body;
            if( !$mail->send() ) {
                return ['status'=>'error','data'=>$mail->ErrorInfo];
            }
            else {
              return ['status'=>'success','data'=>"Email has been sent."];
            }

        } catch (Exception $e) {
          dd($e);
            return ['status'=>'error','data'=>"Message could not be sent."];
        }
    }
}
