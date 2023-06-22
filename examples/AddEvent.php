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
$stmt = "SELECT * FROM Agenda";
$query = sqlsrv_query($conn, $stmt);
?>
<style>

body {
  background-image: url('img/J4x.gif');
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
      <div class="container">
      <div class="row" >
      <div class="col-md-12" style="width:100%;">
      <img src="img/TRAINING.jpg"  style="width:100%;"> <hr>
      <div class="card">
      <div class="card-body">
      <!-- <div class=" bg-Dark text-white" role="alert">
        <h3 class="text-center" >ระบบการจองห้องประชุมออนไลน์</h3> </div>
      </div> </div> <br> -->
      <form action="save_insert.php" method="post" enctype="multipart/form-data">
      <div class="card">
      <div class="card-body">
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
              <label for="sel1">หน่วยงาน</label>
              <font color='red'> * </font>
              <select class="form-control" name="Ref_Agenda_id" id="Agenda" required>
                    <option value="" selected disabled>-กรุณาเลือกหน่วยงาน-</option>
                    <?php while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ ?>
                    <option value="<?=$result['ID']?>"><?=$result['Agenda']?></option>
                    <?php } ?>
              </select>
              </div>
              <div class="col-12 col-sm-6 mb-2">
              <label for="sel1">ตึก</label>
              <font color='red'> * </font>
              <select class="form-control" name="Ref_Building_id" id="Building" required>
              </select>
            </div>

            <div class="col-12 col-sm-6 mb-2">
            <label for="sel2">ห้องประชุม</label>
            <font color='red'> * </font>
            <select class="form-control" name="Ref_Room_id" id="Room" required> 
            </select>
            </div>
            <div class="col-12 col-sm-6 mb-3" >
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
              <button type="button" onclick="javascript:window.history.back()" class="btn btn-Danger btn-block">ย้อนกลับ</button>
            </div>
      </form>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#Agenda').change(function() {
    var ID_Agenda = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {ID:ID_Agenda,function:'Agenda'},
      success: function(data){
        console.log(data)
          $('#Building').html(data); 
      }
    });
  });
 
  $('#Building').change(function() {
    var ID_Building = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {ID:ID_Building,function:'Building'},
      success: function(data){
        console.log(data)
          $('#Room').html(data); 
      }
    });
  });


</script>
