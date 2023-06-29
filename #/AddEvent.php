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
  <title>เพิ่มกำหนดการ</title>
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
              <label for='end'>หน่วยงานที่</label>
              <font color='red'> * </font>
              <input type='text' name='organization' id='organization' value='<?php echo $_SESSION['organization']; ?>' class='form-control' disabled>
            </div>
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>อีเมล์</label>
              <font color='red'> * </font>
              <input type='text' name='email' id='email' value='<?php echo $_SESSION['email']; ?>' class='form-control' disabled>
            </div></div>

            <div class="row">
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>เบอร์ติดต่อ</label>
              <font color='red'> * </font>
              <input type='text' name='Phone' id='Phone' class='form-control' >
            </div>
            <div class="col-12 col-sm-6 mb-2">
            <label for="sel1">หน่วยงานที่รับผิดชอบ</label>
              <font color='red'> * </font>
              <select class="form-control" name="Ref_Agenda_id" id="Agenda" required>
                    <option value="" selected disabled>-กรุณาเลือกหน่วยงาน-</option>
                    <?php while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ ?>
                    <option value="<?=$result['ID']?>"><?=$result['Agenda']?></option>
                    <?php } ?>
              </select>
            </div></div>

        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="row">
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
            </div></div>
          <div class="row">
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>วันที่เข้ารับบริการ</label>
              <font color='red'> * </font>
              <input type='date' name='booking_date' id='date' min='$min' class='form-control' required>
            </div>
              <div class="col-12 col-sm-6 mb-3" >
                <label for='end'>ช่วงเวลาที่เข้ารับบริการ</label>
                <font color='red'> * </font>
                <select class="form-control" name="time" id="time" required>
                  <option value="morning">เช้า (08.30-12.00 น.)</option>
                  <option value="afternoon">บ่าย (13.00-16.30 น.)</option>
                  <option value="all">ทั้งวัน (08.30-16.30 น.)</option>
                </select>
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
<!-- OneTrust Cookies Consent Notice start for tu.ac.th -->
<script type="text/javascript" src="https://cdn-apac.onetrust.com/consent/7dbccbf7-21b3-4ce1-93a9-9c2783ada201/OtAutoBlock.js" ></script>
<script src="https://cdn-apac.onetrust.com/scripttemplates/otSDKStub.js" data-document-language="true" type="text/javascript" charset="UTF-8" data-domain-script="7dbccbf7-21b3-4ce1-93a9-9c2783ada201" ></script>
<script type="text/javascript">
function OptanonWrapper() { }
</script>
<!-- OneTrust Cookies Consent Notice end for tu.ac.th -->
