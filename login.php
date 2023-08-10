
<!DOCTYPE html>
<html lang="en">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
<head>
  <title>เข้าสู่ระบบ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/logined.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div style="overflow-x:auto;">
<div style="overflow-x:auto;">
<form class="login" action="login.php" method="post">
  <h1> Sign in </h1>
  <input type="text" placeholder="Username" name="UserName" required>
  <input type="password" placeholder="Password" name="Password" required>
  <button type="submit">Login</button>
</form>	
</div>
</div>
</body>
</html>


<?php
session_start();
require('ConnectDatabase.php'); 
$username = null;
$password = null;
if (isset($_POST['UserName']) && isset($_POST['Password'])) {
  $username = $_POST['UserName'];
  $password = $_POST['Password'];
}

    $curl = curl_init();
    $Application_Key = "TUa1b9624cd2fb02b2e49c2d28929145d70f0c51f7461367c20d72dbae38ad89457340ade3c630d05c487ac733fe73d6ea";

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://restapi.tu.ac.th/api/v1/auth/Ad/verify",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>'{"UserName" : "'.$username.'","PassWord" : "'.$password.'"}',
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Application-Key: $Application_Key"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      $txt_error = "UserName หรือ Password ของท่านไม่ถูกต้องกรุณา Login  ใหม่";
    } else {
      $data = json_decode($response);
        if ($data->{'status'} == "true"){
        // if ($data->{'status'} == "true" && $data->{'type'} == "employee"){
          $_SESSION['department'] = $data->{'department'};
          $_SESSION['displayname_th'] = $data->{'displayname_th'};
          $_SESSION['email'] = $data->{'email'};
          $_SESSION['organization'] = $data->{'organization'};
          $Email = $_SESSION['email'];

          $sql = "SELECT * FROM Ban_User WHERE Email = '$Email' AND Baned = 'ตักเตือน'";
          $params = array();
          $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
          $stmt = sqlsrv_query( $conn, $sql , $params, $options );
          $row_count = sqlsrv_num_rows( $stmt );

          $sql = "SELECT * FROM Ban_User WHERE Email = '$Email' AND Baned = 'ระงับการใช้งาน'";
          $params = array();
          $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
          $stmt1 = sqlsrv_query( $conn, $sql , $params, $options );
          $row_count1 = sqlsrv_num_rows( $stmt1 );
          
          if ($data->{'displayname_th'} == "ทศพร ยั่งยืน"){
            echo "
            <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'เข้าสู่ระบบสำเร็จ',
                showConfirmButton: false,
                timer: 800, });
                setTimeout(function(){
                    window.location.href = 'index.php';
                 },1500);
            </script>";
          }elseif ($row_count === 1){
            echo "
            <script>
            Swal.fire({
              icon: 'warning',
              title: 'ตักเตือน',
              text: 'คุณโดนตักเตือนจากระบบเนื่องจากคุณไม่มาเข้าใช้งานห้องตามที่กำหนดเงื่อนไขโปรดระมัดระวังในการจองครั้งต่อไป',
              showCancelButton: true,
              confirmButtonText: 'ฉันเข้าใจแล้ว',
            }).then((result) => {
              if (result.value) {
                location.href='index.php' ;
              }
            })
            </script>";
          }elseif ($row_count1 === 1){
            echo "
            <script>
            Swal.fire({
              icon: 'error',
              title: 'ระงับการใช้งาน',
              text: 'คุณโดนระงับการใช้งานเนื่องจากไม่เข้าใช้งานห้องตามกำหนดเกิน 2 ครั้งโปรดติดต่อเจ้าหน้าที่ดูแลระบบ LINE : icttuhelpdesk',
              showCancelButton: true,
              confirmButtonText: 'ฉันเข้าใจแล้ว',
            }).then((result) => {
              if (result.value) {
                location.href='logout.php' ;
              }
            })
            </script>";
          } else {
            echo "
            <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'เข้าสู่ระบบสำเร็จ',
                showConfirmButton: false,
                timer: 800, });
                setTimeout(function(){
                    window.location.href = 'index.php';
                 },1500);
            </script>";
          }
        } elseif ($data->{'message'} == "Users or Password Invalid!"){
          echo "
          <script>
          Swal.fire({
            icon: 'error',
            title: 'กรุณา Login  ใหม่',
            text: 'ไม่พบข้อมูล Users or Password ของท่าน กรณีนักศึกษากรุณาติดต่อสำนักทะเบียน 02-564-4441-79 ต่อ 1651, 1652 , กรณีบุคลากรติดต่อ กองทรัพยากรณ์มนุษย์ 02-5644446 ต่อ 1883',
            confirmButtonText: 'ตกลง',
          }).then((result) => {
            if (result.value) {
              location.href='login.php';
            }
          })
          </script>";
        } elseif ($data->{'message'} == "Password Invalid!"){
          echo "
          <script>
          Swal.fire({
            icon: 'error',
            title: 'กรุณา Login  ใหม่',
            text: 'Password ของท่านไม่ถูกต้อง กรุณาติดต่อ LINE ICT TU Helpdesk https://lin.ee/vBxlVav',
            confirmButtonText: 'ตกลง',
          }).then((result) => {
            if (result.value) {
              location.href='login.php';
            }
          })
          </script>";
    }
  }
?>
