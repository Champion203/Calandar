<?php 
session_start();
require ('menu.php');
require('ConnectDatabase.php'); 
$number = 1;
$organization = $_SESSION['organization'];
  if (isset($_SESSION['email'])){
    $username = $_SESSION['email'] ;
  }

  $sql = "SELECT * FROM Admin WHERE Username = '$username'";
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
      timer: 1500, });
      setTimeout(function(){
          window.location.href = 'index.php';
       },1500);
  </script>";
} elseif ($row_count === 1){
  require ('header.html');
  require('ConnectDatabase.php'); 
  $StatusN = null;

  $sql = "SELECT * FROM Admin WHERE Username = '$username' AND Class = 'SuperAdmin'";
  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $stmt = sqlsrv_query( $conn, $sql , $params, $options );
  $row_count = sqlsrv_num_rows( $stmt );

  if ($row_count === 1){  //check session
    $stmt = "SELECT * FROM Reserve_Room WHERE Status_view <> '0'";
    if (isset($_GET['approve'])){
      $StatusN = 'approve';
      $stmt = "SELECT * FROM Reserve_Room WHERE Status_Reserve = '$StatusN' AND Status_view <> '0' ORDER BY ID" ;
    } elseif (isset($_GET['wait'])){
      $StatusN = 'wait';
      $stmt = "SELECT * FROM Reserve_Room WHERE Status_Reserve = '$StatusN' AND Status_view <> '0' ORDER BY ID" ;
    } elseif (isset($_GET['disapproval'])){
      $StatusN = 'disapproval';
      $stmt = "SELECT * FROM Reserve_Room WHERE Status_Reserve = '$StatusN' AND Status_view <> '0' ORDER BY ID" ;
    }
    $query = sqlsrv_query($conn, $stmt);
    } else {
      $stmt = "SELECT * FROM Reserve_Room WHERE Status_view <> '0' AND Name_Agenda = '$organization'";
      if (isset($_GET['approve'])){
        $StatusN = 'approve';
        $stmt = "SELECT * FROM Reserve_Room WHERE Status_Reserve = '$StatusN' AND Status_view <> '0' AND Name_Agenda = '$organization' ORDER BY ID" ;
      } elseif (isset($_GET['wait'])){
        $StatusN = 'wait';
        $stmt = "SELECT * FROM Reserve_Room WHERE Status_Reserve = '$StatusN' AND Status_view <> '0' AND Name_Agenda = '$organization' ORDER BY ID" ;
      } elseif (isset($_GET['disapproval'])){
        $StatusN = 'disapproval';
        $stmt = "SELECT * FROM Reserve_Room WHERE Status_Reserve = '$StatusN' AND Status_view <> '0' AND Name_Agenda = '$organization' ORDER BY ID" ;
      }
      $query = sqlsrv_query($conn, $stmt);
    }
}

if (isset($_GET['del'])) {
  $del = $_GET['del'];
  echo "
  <script>
  Swal.fire({
    icon: 'warning',
    title: 'ลบการจอง',
    text: 'คุณต้องการลบการจอง',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    confirmButtonText: 'ลบการจอง',
  }).then((result) => {
    if (result.value) {
      location.href='DashboardAdmin.php?del1=$del' ;
    }
  })
  </script>";
}

if (isset($_GET['del1'])){
  // $sql = "DELETE FROM Reserve_Room
  // WHERE ID_Reserve = ? ";
  // $params = array($_GET['del1']);
  //   $stmt = sqlsrv_query( $conn, $sql, $params);
  $ID = $_GET['del1'];
  $view = 0;
  $dis = "disapproval";
  $sql = "UPDATE Reserve_Room SET 
  Status_view = ? ,
  Status_Reserve = ?
  WHERE ID_Reserve = ? ";
  $params = array($view, $dis, $ID);

  $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
  }
    else
    {
        echo "
        <script>
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'ลบเรียบร้อย',
            showConfirmButton: false,
            timer: 1500, });
            setTimeout(function(){
                window.location.href = 'DashboardAdmin.php';
            },1500);
        </script>";
    }
  sqlsrv_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>DashboardAdmin</title> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
  <div class="container-fluid ">
  <img src="img/TRAINING.jpg"  style="width:100%;"> <hr>
  <div class="row" >
  </div> </div></div> </div></div>  
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
      <a href="DashboardAdmin.php?wait" class="btn btn-info" role="button"> รออนุมัติ</a>
      <a href="DashboardAdmin.php?disapproval" class="btn btn-danger" role="button"> ไม่อนุมัติ</a></div></div>
  <ul class="nav navbar-nav navbar-right">
  <table id="tables" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
              <th >ลำดับ</th>
              <th >รหัสการจอง</th>
              <th>อาคาร</th>
              <th>ห้องประชุม</th>
              <th>ชื่อ-นามสกุล</th>
              <th>วันที่เข้ารับบริการ</th>
              <th>สิ้นสุด</th>
              <th>สถานะ</th>
              <th>จัดการ</th>
          </tr>
          </th>
          <tbody>
          <?php while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) { 
                  $end = str_replace("T"," ",$result['End_Reserve']);
                  $datestart=date_create($result['Start_Reserve']);
                  $dateend=date_create("$end");?>
                  <tr>
                      <td align="center"><?php echo $number; ?></td>
                      <td align="center"><?php echo $result["ID_Reserve"]; ?></td>
                      <td align="center"><?php echo $result["Name_Building"]; ?></td>
                      <td align="center"><?php echo $result["Name_Room"]; ?></td>
                      <td align="center"><?php echo $result["FullName"]; ?></td>
                      <td align="center"><?php echo date_format($datestart,"วันที่ d/m/Y เวลา H:i:s น."); ?></td>
                      <td align="center"><?php echo date_format($dateend,"วันที่ d/m/Y เวลา H:i:s น."); ?></td>
                      <td align="center">  <?php if ($result['Status_Reserve'] == 'approve') { ?>
                        <span class="badge bg-success">อนุมัติ</span>                     
                            <?php }elseif ($result['Status_Reserve'] == 'wait') { ?>
                              <span class="badge bg-info">รออนุมัติ</span>
                            <?php }elseif ($result['Status_Reserve'] == 'cancel') { ?>
                              <span class="badge bg-danger">ยกเลิก</span>
                            <?php } else { ?>
                              <span class="badge bg-danger">ไม่อนุมัติ</span>
                            <?php }?></td>
                     </td>
                      <td align="center"><a href="approve.php?ID_Reserve=<?php echo $result["ID_Reserve"];?>" title="จัดการ"><i style='font-size:24px' class='material-icons'>&#xe065;</i></a>
                      <a href="PDF.php?id=<?php echo $result["ID"];?>" title="exportPDF"><i class="material-icons" style="font-size:24px">&#xe555;</i></a>
                      <a href="DashboardAdmin.php?del=<?php echo $result["ID_Reserve"];?>" title="ลบการจอง"><i class="material-icons" style="font-size:24px">&#xe92b;</i></a></td>

                  </tr>
              <?php $number++; } ?> 
          <tfoot>
          <tr>
          <th >ลำดับ</th>
          <th>รหัสการจอง</th>
              <th>อาคาร</th>
              <th>ห้องประชุม</th>
              <th>ชื่อ-นามสกุล</th>
              <th>วันที่เข้ารับบริการ</th>
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

<style>
body {
  background-image: url('img/J4x.gif');
  width:100%;
  margin: 0;
  padding: 0;
  font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
  font-size: 14px;
}
</style>