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
  require('ConnectDatabase.php'); 
  if (isset($_SESSION['email'])){
    $username = $_SESSION['email'] ;
  }
    
  $sql = "SELECT * FROM Admin WHERE Username LIKE '$username' AND Class LIKE 'SuperAdmin'";
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
        timer: 1000, });
        setTimeout(function(){
            window.location.href = 'index.php';
        },1000);
  </script>";
  } elseif ($row_count === 1) {
    $stmt = "SELECT * FROM Admin ORDER BY ID" ;
    $query = sqlsrv_query($conn, $stmt);
  }
  $i = 1;

  if (isset($_GET['del'])) {
    $del = $_GET['del'];
    echo "
    <script>
      Swal.fire({
        icon: 'warning',
        title: 'ลบสิทธิ์',
        text: 'คุณต้องการลบสิทธิ์',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'ลบสิทธิ์',
      }).then((result) => {
        if (result.value) {
          location.href='AddAdmin.php?del1=$del' ;
        }
    })
    </script>";
  }
  if (isset($_GET['del1'])) {
    $sql = "DELETE FROM Admin
    WHERE ID = ? ";

    $params = array($_GET['del1']);
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
                    window.location.href = 'AddAdmin.php';
                },1500);
          </script>";
      }
    sqlsrv_close($conn);
  }
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
  <title>Add Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
      <div class="container">
      <div class="row" >
      <div class="col-md-12" style="width:100%;">
      <img src="img/TRAINING.jpg"  style="width:100%;"> <hr>
      <div class="card">
      <div class="card-body">
      <form action="save_admin.php" method="post" enctype="multipart/form-data">
      <div class="card">
      <div class="card-body">
      <div class="row">
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>Email :</label>
              <font color='red'> * </font>
              <input type='text' name='Email' id='Email' placeholder='xxxx@tu.ac.th' class='form-control' required>
            </div>
            <div class="col-12 col-sm-6 mb-2">
            <label for="class">ระดับ :</label>
            <font color='red'> * </font>
                <select class='form-control' id='class' name='Class' placeholder='xxxx@tu.ac.th' required>
                <option value="" selected disabled>-กรุณาเลือกระดับ-</option>
                <option>SuperAdmin</option>
                <option>Admin</option>
                <option>User</option>
            </select>
            </div></div>
            <div class="row">
            <div class="d-grid gap-2 col-12 col-sm-12 mx-auto">
              <button type="summit" class="btn btn-success btn-block">เพิ่ม ADMIN</button>
            </div>
      </form></div> <hr>
      <table id="tables" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
              <th >ลำดับ</th>
              <th >Email</th>
              <th >ระดับ</th>
              <th >ลบ</th>
          </tr>
          </th>
          <tbody>
          <?php while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) { 
            			$start = str_replace("T"," ",$result['Start_Reserve']);
                  $end = str_replace("T"," ",$result['End_Reserve']);
                  $datestart=date_create("$start");
                  $dateend=date_create("$end");?>
                  <tr>
                      <td align="center"><?php echo $i; ?></td>
                      <td align="center"><?php echo $result["Username"]; ?></td>
                      <td align="center"><?php echo $result["Class"]; ?></td>
                      <td align="center"><a href="AddAdmin.php?del=<?php echo $result["ID"];?>" title="Delete"><i class="material-icons" style="font-size:24px">&#xe92b;</i></a></td>
              <?php $i++; } ?> 
          <tfoot>
          <tr>
          <th >ลำดับ</th>
            <th >Email</th>
            <th >ระดับ</th>
            <th >ลบ</th>
          </tfoot>
          </tbody>
        </div>
      </table>
    </div>
</body>
</html>