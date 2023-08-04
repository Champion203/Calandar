<?php 
session_start();
  require ('Header.html'); 
  require ('menu.php');
  $number = 1;
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
        location.href='dasboard_user.php?del1=$del' ;
      }
    })
    </script>";
  }

  if (isset($_GET['del1'])){
    if ($datediff >= '3'){
      echo "
      <script>
      Swal.fire({
          position: 'top-center',
          icon: 'error',
          title: 'ไม่สามารถลบได้เนื่องจากเกินวันที่กำหนด',
          showConfirmButton: false,
          timer: 800, });
          setTimeout(function(){
              window.location.href = 'dasboard_user.php';
           },1500);
      </script>";
    }
    $ID = $_GET['del1'];
    $view = 2;
    $dis = "cancel";
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
                  window.location.href = 'dasboard_user.php';
              },1500);
          </script>";
      }
    sqlsrv_close($conn);
  }

  if (!$_SESSION["displayname_th"]){  //check session
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
 } else {
    if (isset($_SESSION['email'])){
      $email = $_SESSION['email'] ;
    }
    require('ConnectDatabase.php'); 
    $stmt = "SELECT * FROM Reserve_Room WHERE email = '$email' AND Status_view <> '0' ORDER BY ID";
    $query = sqlsrv_query($conn, $stmt);
    require ('header.html');
 }

  ?>
  <!DOCTYPE html>
  <html lang="th">
  <head>
  <title>dashboard User</title> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<!-- OneTrust Cookies Consent Notice start for tu.ac.th -->
<script type="text/javascript" src="https://cdn-apac.onetrust.com/consent/7dbccbf7-21b3-4ce1-93a9-9c2783ada201/OtAutoBlock.js" ></script>
<script src="https://cdn-apac.onetrust.com/scripttemplates/otSDKStub.js" data-document-language="true" type="text/javascript" charset="UTF-8" data-domain-script="7dbccbf7-21b3-4ce1-93a9-9c2783ada201" ></script>
<script type="text/javascript">
function OptanonWrapper() { }
</script>
<!-- OneTrust Cookies Consent Notice end for tu.ac.th -->
  <div class="container-fluid ">
  <div class="row" >
  <div class="col-md-12" style="width:100%;">
      <img src="img/TRAINING.jpg"  style="width:100%;"> <hr>
  <!-- <div class="card">
  <div class="card-body">
  <div class=" bg-dark text-white" role="alert">
    <h3 class="text-center" >ประวัติการจอง</h3> </div> -->
  </div> </div></div> </div></div>  <br>
  <div class="container-fluid ">
  <div class="row" >
  <div class="col-md-12" style="width:100%;">
  <div class="card">
  <div class="card-body">
  <div class="card-header  text-black">
    ข้อมูล สถิติ
  </div> <br>
  <div class="container-fluid ">
  <div style="overflow-x:auto;">
  <ul class="nav navbar-nav navbar-right">
  <table id="tables" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr><th>ลำดับ</th>
              <th>ชื่อ-นามสกุล</th>
              <th>ห้องประชุม</th>
              <th>เริ่ม</th>
              <th>สิ้นสุด</th>
              <th>สถานะ</th>
              <th>ยกเลิก</th>
          </tr>
          </th>
          <tbody>
          <?php while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) { 
                        			$start = str_replace("T"," ",$result['Start_Reserve']);
                              $end = str_replace("T"," ",$result['End_Reserve']);
                              $datestart=date_create("$start");
                              $dateend=date_create("$end");

                              $date1 = date_create(date_format($datestart,"Y/m/d"));
                              $date2 = date_create(date("Y/m/d"));
                              $diff = date_diff($date2,$date1);
                              $datediff = $diff->format("%R%a");
                              ?>
                  <tr>
                      <td align="center"><?php echo $number; ?></td>
                      <td align="center"><?php echo $result["FullName"]; ?></td>
                      <td align="center"><?php echo $result["Name_Room"]; ?></td>
                      <td align="center"><?php echo date_format($datestart,"วันที่ d/m/Y เวลา H:i:s น."); ?></td>
                      <td align="center"><?php echo date_format($dateend,"วันที่ d/m/Y เวลา H:i:s น."); ?></td>
                      <td align="center"><?php if ($result['Status_Reserve'] == 'approve') { ?>
                              <span class="badge bg-success">อนุมัติ</span>                     
                            <?php }elseif ($result['Status_Reserve'] == 'wait') { ?>
                              <span class="badge bg-info">รออนุมัติ</span>
                            <?php }elseif ($result['Status_Reserve'] == 'cancel') { ?>
                              <span class="badge bg-danger">ยกเลิก</span>
                            <?php } else { ?>
                              <span class="badge bg-danger">ไม่อนุมัติ</span>
                            <?php }?></td>
                            <td><center><?php 
                            $id = $result["ID_Reserve"];
                            if ($datediff < '3') { 
                              echo "<input type='button' class='btn btn-danger disabled' value='ยกเลิก'>";
                            }elseif ($datediff >= '3') { 
                              echo "<a href='dasboard_user.php?del=$id' class='btn btn-danger' role='button'>ยกเลิก</a>";
                            }?></td></center>
                          </tr>
              <?php $number++; } ?>
          <tfoot>
          <tr><th>ลำดับ</th>
            <th>ชื่อ-นามสกุล</th>
              <th>ห้องประชุม</th>
              <th>เริ่ม</th>
              <th>สิ้นสุด</th>
              <th>สถานะ</th>
              <th>ยกเลิก</th>
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