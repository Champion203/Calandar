<?php
session_start();
if (isset($_SESSION['displayname_th'])) {
    include 'send_mail/phpmailer/PHPMailerAutoload.php';
    /* ------------------------------------------------------------------------------------------------------------- */
    $message1 = "ชื่อ-นามสกุล: " . $_SESSION['displayname_th'] . "\n";
    $message2 = "อีเมล์: " . $_SESSION['email'] . "\n";
    $message3 .= "อาคาร: " . $Building_id . "\n";
    $message4 = "ห้อง: " . $_POST["Ref_Room_id"] . "\n";
    $message5 = "สามารถติดตามสถานะได้ทาง ";
    $message6 = "ตั้งแต่วันที่: " . $datestart . " น. " . "ถึงวันที่: " . $dateend . " น.";
    $message7 = "เบอร์โทรศัพท์: " . $_POST["Phone"];
    $link = 'https://reserve.sa.ict.tu.ac.th/index.php';
    /* ------------------------------------------------------------------------------------------------------------- */

    $mail = new PHPMailer(true);
    $mail->CharSet = "utf-8";
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply-ict@tu.ac.th';
    $mail->Password = 'N0r3ply@2o23';
    $mail->SetFrom('no-reply-ict@tu.ac.th', 'FromEmail');
    $mail->addAddress($_SESSION['email'], 'ToEmail');
    //$mail->SMTPDebug  = 3;
    //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
    $mail->IsHTML(true);
    $mail->Subject = 'ท่านได้ทำการจองห้องประชุมเรียบร้อยแล้ว โปรดรอเจ้าหน้าที่ทำการอนุมัติภายใน 5 วันทำการ';
    $mail->Body = "ท่านได้ทำการจองห้องประชุมเรียบร้อยแล้ว โปรดรอเจ้าหน้าที่ทำการอนุมัติภายใน 5 วันทำการ จากนั้นเจ้าหน้าที่จะตอบกลับมาทาง Email อีกครั้ง<br>
                $message1<br>
                $message7<br>
                $message2<br>
                $message3<br>
                $message4<br>
                $message6<br>
                $message5 Click <a href='$link'>meeting.tu.ac.th</a> to visit the link.<br>
                ";

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
