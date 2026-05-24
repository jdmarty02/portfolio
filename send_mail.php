<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'johnbenedictmarty.ph@gmail.com';
        $mail->Password = 'rdjf lymv fqyz ckat';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('johnbenedictmarty.ph@gmail.com', 'Portfolio Contact Form');
        $mail->addAddress('johnbenedictmarty.ph@gmail.com');

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;

$mail->Body = "
<!DOCTYPE html>
<html>
<head>
  <meta charset='UTF-8'>
</head>

<body style='margin:0; padding:0; background:#eef2f7; font-family:Arial, sans-serif;'>

  <div style='max-width:680px; margin:35px auto; background:#ffffff; border-radius:18px; overflow:hidden; box-shadow:0 10px 30px rgba(15,23,42,0.12);'>

    <div style='background:linear-gradient(135deg,#0f172a,#1e3a8a); padding:35px 28px; text-align:center;'>
      <h1 style='color:#ffffff; margin:0; font-size:26px; letter-spacing:-0.5px;'>New Portfolio Inquiry</h1>
      <p style='color:#dbeafe; margin:10px 0 0; font-size:14px;'>A visitor submitted your portfolio contact form</p>
    </div>

    <div style='padding:35px 32px;'>

      <p style='margin:0 0 8px; color:#64748b; font-size:12px; font-weight:bold; letter-spacing:1px;'>EMAIL SUBJECT</p>
      <h2 style='margin:0 0 25px; color:#0f172a; font-size:24px;'>$subject</h2>

      <div style='background:#f8fafc; border:1px solid #e2e8f0; border-radius:14px; padding:22px; margin-bottom:25px;'>

        <p style='margin:0 0 15px; color:#0f172a; font-size:15px;'>
          <strong style='display:inline-block; width:130px; color:#475569;'>Full Name:</strong>
          $name
        </p>

        <p style='margin:0 0 15px; color:#0f172a; font-size:15px;'>
          <strong style='display:inline-block; width:130px; color:#475569;'>Email:</strong>
          <a href='mailto:$email' style='color:#2563eb; text-decoration:none;'>$email</a>
        </p>

        <p style='margin:0; color:#0f172a; font-size:15px;'>
          <strong style='display:inline-block; width:130px; color:#475569;'>Contact No.:</strong>
          $contact
        </p>

      </div>

      <p style='margin:0 0 10px; color:#64748b; font-size:12px; font-weight:bold; letter-spacing:1px;'>MESSAGE</p>

      <div style='background:#ffffff; border:1px solid #cbd5e1; border-radius:14px; padding:22px; color:#334155; font-size:15px; line-height:1.7;'>
        " . nl2br($message) . "
      </div>

      <div style='margin-top:28px; text-align:center;'>
        <a href='mailto:$email' style='display:inline-block; background:#0f172a; color:#ffffff; padding:13px 26px; border-radius:30px; text-decoration:none; font-weight:bold; font-size:14px;'>
          Reply to Sender
        </a>
      </div>

    </div>

    <div style='background:#f8fafc; padding:20px; text-align:center; border-top:1px solid #e2e8f0;'>
      <p style='margin:0; color:#94a3b8; font-size:12px;'>Sent automatically from your Portfolio Contact Form</p>
    </div>

  </div>

</body>
</html>
";

        $mail->send();

        echo "<script>
            alert('Message sent successfully!');
            window.location.href='index.php#contact';
        </script>";

    } catch (Exception $e) {
        echo "<script>
            alert('Message could not be sent. Error: {$mail->ErrorInfo}');
            window.location.href='index.php#contact';
        </script>";
    }
}
?>