<?php 
  session_start();
  require ('menu.php');
  require('ConnectDatabase.php'); 
  if (isset($_SESSION['email'])){
    $username = $_SESSION['email'] ;
  }
  
  $sql = "SELECT * FROM Admin WHERE Username LIKE '$username'";
  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $stmt = sqlsrv_query( $conn, $sql , $params, $options );
   
  $row_count = sqlsrv_num_rows( $stmt );
  
  if ($row_count === 0){  //check session
  echo "
  <script>
  Swal.fire({
      position: 'top-center',
      icon: 'error',
      title: 'ท่านไม่มีสิทธิ์เข้าถึงหน้านี้',
      showConfirmButton: false,
      timer: 800, });
      setTimeout(function(){
          window.location.href = 'index.php';
       },800);
  </script>";
  } elseif ($row_count === 1){
    if(isset($_GET["ID_Reserve"])){
      $ID_Reserve = $_GET["ID_Reserve"];
      require('ConnectDatabase.php'); 
      $stmt = "SELECT * FROM Reserve_Room WHERE ID_Reserve LIKE '%".$ID_Reserve."%'";
      $query = sqlsrv_query($conn, $stmt);
      require ('header.html');
      $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Calendar Event</title> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/dasboard.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
</head>

<body>
<div class="container-fluid">
<div class="card">
      <div class="card-body">
      <div class=" bg-Dark text-white" role="alert">
        <h3 class="text-center" >ระบบการจองห้องประชุมออนไลน์</h3> </div>
      </div> </div> <br>
      <form action="save_approve.php" method="post" enctype="multipart/form-data">
      <div class="row">
            <div class="col-12 col-sm-4 mb-2">
              <label for='end'>รหัสการจอง</label>
              <input type='text' name='ID' id='ID' value='<?php echo $result['ID_Reserve']; ?>' class='form-control'>
            </div>
            <div class="col-12 col-sm-4 mb-2">
              <label for='end'>ชื่อ-นามสกุล ผู้จอง</label>
              <input type='text' name='Name' id='Name' value='<?php echo $result['FullName']; ?>' class='form-control' disabled>
            </div>
            <div class="col-12 col-sm-4 mb-2">
              <label for='end'>แผนก</label>
              <input type='text' name='department' id='department' value='<?php echo $result['department']; ?>' class='form-control' disabled>
            </div></div>
            <div class="row">
            <div class="col-12 col-sm-4 mb-2">
              <label for='end'>หน่วยงาน</label>
              <input type='text' name='organization' id='organization' value='<?php echo $result['organization']; ?>' class='form-control' disabled>
            </div>
            <div class="col-12 col-sm-4 mb-2">
              <label for='end'>อีเมล์</label>
              <input type='text' name='email' id='email' value='<?php echo $result['email']; ?>' class='form-control' disabled>
            </div>
            <div class="col-12 col-sm-4 mb-2">
              <label for='end'>ตึก</label>
              <input type='text' name='email' id='buiding' value='<?php echo $result['Name_Building']; ?>' class='form-control' disabled>
            </div></div>
            <div class="row">
           <div class="col-12 col-sm-4">
           <label for='end'>ห้องประชุม</label>
             <input type='text' name='Name_Room' id='Name_Room' value='<?php echo $result['Name_Room']; ?>' class='form-control' disabled>
              </div>
              <div class="col-12 col-sm-4 mb-2">
              <label for='end'>วันเวลาที่เริ่มต้น</label>
              <input type='datetime-local' name='Start' id='Start' value='<?php echo $result['Start_Reserve']; ?>' class='form-control' disabled>
            </div>
           <div class="col-12 col-sm-4">
           <label for='end'>วันเวลาที่สิ้นสุด</label>
             <input type='datetime-local' name='End' id='End' value='<?php echo $result['End_Reserve']; ?>' class='form-control' disabled>
              </div></div>
              <div class="row">
              <div class="col-12 col-sm-4 mb-2">
              <label for='end'>เบอร์โทรศัพท์</label>
              <input type='text' name='Detail' id='Detail' value='<?php echo $result['Phone']; ?>' class='form-control' disabled>
            </div> 
            <div class="col-12 col-sm-4 mb-2">
                <label for="sel1">สถานะ </label>
                <font color='red'> * </font>
                <select class="form-control" name="Status" id="Status" required>
                  <option value="approve">อนุมัติ</option>
                  <option value="wait">รอดำเนินการ</option>
                  <option value="disapproval">ไม่อนุมัติ</option>
                </select>
              </div>
              <div class="col-12 col-sm-4 mb-2">
              <label for='end'>Comment</label>
              <input type='text' name='Comment' id='Comment' class='form-control' >
            </div></div> <br>
            <div class="row">
            <div class="col-12 col-sm-6">
              <button type="summit" class="btn btn-success btn-block">บันทึก</button>
            </div>
            <div class="col-12 col-sm-6">
              <button type="button" onclick="javascript:window.history.back()" class="btn btn-Danger btn-block">ย้อนกลับ</button>
            </div>
      </form>
    </div>
  </form>
</body>
</html>