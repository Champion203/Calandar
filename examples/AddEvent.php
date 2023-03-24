<?php 
session_start();
require ('menu.php');
if (!$_SESSION["displayname_th"])  //check session
echo "
<script>
Swal.fire({
    position: 'top-center',
    icon: 'error',
    title: 'ท่านยังไม่ได้เข้าสู่ระบบโปรดเข้าสู่ระบบ',
    showConfirmButton: false,
    timer: 800, });
    setTimeout(function(){
        window.location.href = 'login.php';
     },1500);
</script>";
require ('Header.html'); 
$min = date('Y-d-m H:i:s');

require('ConnectDatabase.php'); 
$stmt = "SELECT DISTINCT Agenda FROM Room";
$query = sqlsrv_query($conn, $stmt);

$stmt2 = "SELECT DISTINCT Building FROM Room";
$query2 = sqlsrv_query($conn, $stmt2);

$stmt3 = "SELECT DISTINCT Room FROM Room";
$query3 = sqlsrv_query($conn, $stmt3);
?>
<style>

body {
  margin: 0;
  padding: 0;
  font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
  font-size: 14px;
}

#script-warning {
  display: none;
  background: #eee;
  border-bottom: 1px solid #ddd;
  padding: 0 10px;
  line-height: 40px;
  text-align: center;
  font-weight: bold;
  font-size: 12px;
  color: red;
}

#loading {
  display: none;
  position: absolute;
  top: 10px;
  right: 10px;
}

</style>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Calendar Event</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
      <div class="container">
      <form action="save_insert.php" method="post" enctype="multipart/form-data">
      <div class="row">
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>ชื่อ-นามสกุล ผู้จอง</label>
              <font color='red'> * </font>
              <input type='text' name='Name' id='Name' value='<?php echo $_SESSION['displayname_th']; ?>' class='form-control' disabled>
            </div>
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>แผนก</label>
              <font color='red'> * </font>
              <input type='text' name='department' id='department' value='<?php echo $_SESSION['department']; ?>' class='form-control' disabled>
            </div></div>
            <div class="row">
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>หน่วยงาน</label>
              <font color='red'> * </font>
              <input type='text' name='organization' id='organization' value='<?php echo $_SESSION['organization']; ?>' class='form-control' disabled>
            </div>
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>อีเมล์</label>
              <font color='red'> * </font>
              <input type='text' name='email' id='email' value='<?php echo $_SESSION['email']; ?>' class='form-control' disabled>
            </div></div>
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="row">
              <div class="col-12 col-sm-6 mb-2">
                <label for="sel1">เลือกห้อง </label>
                <font color='red'> * </font>
                <select class="form-control" name="sel1" id="sel1" required>
                  <option>ห้องประชุม 1</option>
                  <option>ห้องประชุม 2</option>
                  <option>ห้องประชุม 3</option>
                </select>

                <select  name="Agenda" id="Agenda" class="form-control" required>
                   <?php while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) { ?>
                      <option value="<?php echo $result['Agenda'];?>"><?php echo $result['Agenda'];?></option>
                    <?php } ?>
                 </select>

                 <select  name="products" id="products" class="form-control" required>
                    <option value="">เลือกตึก</option>
                 </select>
                 
                 <select  name="Room_id" id="Room" class="form-control" required>
                    <option value="">เลือกห้อง</option>
                 </select>
              </div>
            <div class="col-12 col-sm-6 mb-2">
              <label for='start'>วันเวลาที่เริ่มต้น <font color='red'> * </font></label>
              <input type='datetime-local' name='booking_start_date' min='$min' id='start' class='form-control' required>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>วันเวลาที่สิ้นสุด</label>
              <font color='red'> * </font>
              <input type='datetime-local' name='booking_end_date' id='end' min='$min' class='form-control' required>
            </div>
              <div class="col-12 col-sm-6 mb-3" >
                <label for='end'>รายละเอียด</label>
                <font color='red'> * </font>
                <input type="text" name="detail" id='detail' class="form-control" required>
              </div>
            </div> 
            <div class="row">
            <div class="col-12 col-sm-6">
              <button type="summit" class="btn btn-success btn-block">เพิ่มกำหนดการ</button>
            </div>
            <div class="col-12 col-sm-6">
              <button type="button" onclick="javascript:window.history.back()" class="btn btn-secondary btn-block">ย้อนกลับ</button>
            </div>
      </form>
    </div>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/script.js"></script>
</body>
</html>

