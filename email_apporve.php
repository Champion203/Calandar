
<?php
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
/* ------------------------------------------------------------------------------------------------------------- */
$message1 = "ชื่อ-นามสกุล: ".$Name."\n";
$message2= "อีเมล์: ".$email."\n";
$message3.= "อาคาร: ".$buiding."\n";
$message4= "ห้อง: ".$Name_Room."\n";
$message5= "สามารถติดตามสถานะได้ทาง ";
$message6= "ตั้งแต่วันที่: ".$Start." น. "."ถึงวันที่: ".$End." น.";
$message7= "เบอร์โทรศัพท์: ".$Phone;
$link = 'https://devphp.sa.ict.tu.ac.th/meetingroom/';
/* ------------------------------------------------------------------------------------------------------------- */

$mail = new PHPMailer(true);
$mail->CharSet = "utf-8";
$mail->isSMTP();
$mail->Host = 'smtp.office365.com';
$mail->Port       = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth   = true;
$mail->Username = 'champ894@tu.ac.th';
$mail->Password = '1139700012961';
$mail->SetFrom('champ894@tu.ac.th', 'FromEmail');
$mail->addAddress($email, 'ToEmail');
//$mail->SMTPDebug  = 3;
//$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
$mail->IsHTML(true);

if ($Status == 'approve'){
    $mail->Subject = 'สถานะการจองของท่านได้ถูกอนุมัติเรียบร้อยแล้ว';
    $mail->Body = "<b>สถานะการจองของท่านได้ถูกอนุมัติเรียบร้อยแล้ว</b><br>
               $message1<br>
               $message7<br>
               $message2<br>
               $message3<br>
               $message4<br>
               $message6<br>
               $message5 Click <a href='$link'>meeting.tu.ac.th</a> to visit the link.<br><br>
               <b>หมายเหตุ หากท่านไม่มาเข้าใช้งานโปรดกดยกเลิกการจองก่อนวันเข้าใช้งาน 3 วัน มิเช่นนั้นท่านจะถูกระงับการใช้งานการเข้าใช้ระบบ</b>
               ";
} elseif ($Status == 'disapproval'){
    $mail->Subject = 'สถานะการจองของท่านได้ถูกปฏิเสธการจอง';
    $mail->Body = "<b>สถานะการจองของท่านได้ถูกปฏิเสธการจอง</b><br>
               $message1<br>
               $message7<br>
               $message2<br>
               $message3<br>
               $message4<br>
               $message6<br>
               $message5 Click <a href='$link'>meeting.tu.ac.th</a> to visit the link.<br><br>  
               <b>หมายเหตุ เนื่องจากวันดังกล่าวได้ปิดทำการหรือได้มีการใช้งานอยู่กรุณาจองใหม่อีกครั้ง</b>   
               ";
}

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}