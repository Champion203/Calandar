<?php 

session_start();
require ('menu.php');
require('ConnectDatabase.php'); 
$username = $_SESSION['email'] ;

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
       },1500);
  </script>";
}

if (isset($_GET['del'])) {
  $del = $_GET['del'];
  echo "
  <script>
  Swal.fire({
    icon: 'warning',
    title: 'Delete',
    text: 'คุณต้องการ Delete',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    confirmButtonText: 'Delete',
  }).then((result) => {
    if (result.value) {
      location.href='delete.php?del=' + $del;
    }
  })
  </script>";

}
$StatusN = 'wait';
if (isset($_GET['approve'])){
  $StatusN = 'approve';
} elseif (isset($_GET['wait'])){
  $StatusN = 'wait';
} elseif (isset($_GET['disapproval'])){
  $StatusN = 'disapproval';
}

require('ConnectDatabase.php'); 
$stmt = "SELECT * FROM Reserve_Room WHERE Status_Reserve LIKE '$StatusN'";
$query = sqlsrv_query($conn, $stmt);
require ('header.html');

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Calendar Event</title> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
  <script src="js/cookie.js"> </script>
  <div class="container-fluid ">
  <!--<img src="img/TRAINING.jpg"  style="width:100%;"> <hr>-->
  <div class="row" >
  <div class="col-md-12" style="width:100%;">
  <div class="card">
  <div class="card-body">
  <div class=" bg-info text-white" role="alert">
    <h3 class="text-center" >ระบบการจองห้องประชุมออนไลน์</h3> </div>
  </div> </div></div> </div></div>  <br>
  <div class="container-fluid">
  <div class="row" >
  <div class="col-md-12" style="width:100%;">
  <div class="card">
  <div class="card-body">
  <div class="container-fluid">
  <div style="overflow-x:auto;">
  <div class="row">
    <div align="right" class="col-12 col-sm-12 mb-2">
      <a href="DashboardAdmin.php?approve" class="btn btn-success" role="button"> อนุมัติ</a>
      <a href="DashboardAdmin.php?wait" class="btn btn-info" role="button"> รอดำเนินการ</a>
      <a href="DashboardAdmin.php?disapproval" class="btn btn-danger" role="button"> ไม่อนุมัติ</a></div></div>
  <ul class="nav navbar-nav navbar-right">
  <table id="tables" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
              <th>รหัสการจอง</th>
              <th>ห้องประชุม</th>
              <th>ชื่อ-นามสกุล</th>
              <th>เริ่ม</th>
              <th>สิ้นสุด</th>
              <th>สถานะ</th>
              <th>จัดการ</th>
          </tr>
          </th>
          <tbody>
          <?php while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) { 
            			$start = str_replace("T"," ",$result['Start_Reserve']);
                  $end = str_replace("T"," ",$result['End_Reserve']);
                  $datestart=date_create("$start");
                  $dateend=date_create("$end");?>
                  <tr>
                      <td><?php echo $result["ID_Reserve"]; ?></td>
                      <td><?php echo $result["Name_Room"]; ?></td>
                      <td><?php echo $result["FullName"]; ?></td>
                      <td><?php echo date_format($datestart,"วันที่ d/m/Y เวลา H:i:s น."); ?></td>
                      <td><?php echo date_format($dateend,"วันที่ d/m/Y เวลา H:i:s น."); ?></td>
                      <td>  <?php if ($result['Status_Reserve'] == 'approve') { ?>
                              <span class="badge bg-success">อนุมัติ</span>                     
                            <?php }elseif ($result['Status_Reserve'] == 'wait') { ?>
                              <span class="badge bg-info">รอดำเนินการ</span>
                            <?php } else { ?>
                              <span class="badge bg-danger">ไม่อนุมัติ</span>
                            <?php }
                     ?></td>
                      <td align="center"><a href="approve.php?ID_Reserve=<?php echo $result["ID_Reserve"];?>" title="จัดการ"><i style='font-size:24px' class='fas'>&#xf044;</i></a></td>
                  </tr>
              <?php } ?> 
          <tfoot>
          <tr>
          <th>รหัสการจอง</th>
              <th>ห้องประชุม</th>
              <th>ชื่อ-นามสกุล</th>
              <th>เริ่ม</th>
              <th>สิ้นสุด</th>
              <th>สถานะ</th>
              <th>จัดการ</th>
          </tr>
          </tfoot>
          </tbody>
        </div>
      </table>
      </div> <br>
      <div class="card-footer text-muted">
          มหาวิทยาลัยธรรมศาสตร์รังสิต | ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร
        </div>
      </div>
      </div>
      </div>
      </div>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function() {
  var table = $('#tables').DataTable( {  
    responsive: true,   
    autoWidth: false,     
    "oLanguage": {
      "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
      "sZeroRecords": "ไม่พบข้อมูลที่ค้นหา",
      "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
      "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
      "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
      "sSearch": "ค้นหา :",
      "aaSorting" :[[0,'desc']],
      "oPaginate": {
      "sFirst":    "หน้าแรก",
      "sPrevious": "ก่อนหน้า",
      "sNext":     "ถัดไป",
      "sLast":     "หน้าสุดท้าย"
      },
    },    
  } ); 
  } );
</script>