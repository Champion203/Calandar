<?php session_start();
require ('Header.html'); 
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <title>ระบบการจองห้องประชุมออนไลน์</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style type="text/css">
    body{
        font-family: system-ui,-apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,sans-serif;
        font-size: 14px;
    }
    .pic_preview{height:auto;padding-bottom:100%;background-size:cover;background-position:center;}
    .price{font-size: 18px;font-weight: 500;color: #f57224;}
    .discount_price{font-size: 10px;color: #9e9e9e;}
    .cus-icon:before {
        width: 30px;
        height: 30px;
    }   
    /*sidemenu ด้านซ้าย*/
    .l-sidenav {
        position: fixed; 
        z-index: 1040; 
        top: 0; 
        left: 0;    
        height: 100%; 
        width: 0; 
        overflow-x: hidden; 
    }   
    </style>
</head>
<body>
  
<!-- sidemenu ด้านซ้าย-->
<nav class="l-sidenav bg-light">
<div class="card bg-light">
  <div class="navbar navbar-light">
  <a class="invisible"></a>
  <button type="button" class="close close-l-sidenav btn pl-2">	
  <span aria-hidden="true">&times;</span>
</button>
 
  </div>
  <div class="card-body pt-1 text-center">
  <!-- <i class='fas fa-user-alt' style='font-size:48px;color:red'></i> -->
    <h6 class="card-title">โปรดเข้าสู่ระบบก่อนทำการจองห้อง</h6>
    <p class="card-text">
    <?php echo $_SESSION['organization']; ?>
    </p>
  </div>
</div>
<ul class="list-group">
  <li class="list-group-item align-items-center">
  <a class="nav-link active" href="index.php">หน้าแรก</a>
  </li></a>
  <ul class="list-group">
  <li class="list-group-item align-items-center">
  <a class="nav-link active" href="login.php">เข้าสู่ระบบ</a>
  </li></a>
</nav>
  
<!-- ส่วนของการใช้งาน navbar-->
 <nav class="navbar navbar-dark bg-dark ">
<!-- ปุมด้านซ้าย แสดงเมนู-->
  <button class="navbar-toggler border-0 px-0 open-l-sidenav"  type="button">
    <i class="fas fa-bars cus-icon fa-fw py-1"></i>
    <a class="navbar-brand">MENU</a>
  </button> 
<!-- ปุมด้านขวา แสดงเมนู  -->
    <div class="btn-group">
    <a href="index.php" class="btn btn-primary"><i class="fas fa-home cus-icon py-1"></i></a>
      <button type="button" class="navbar-toggler border-0 px-2">
      </button>
      <a href="login.php" class="btn btn-success"><i class="fas fa-sign-out-alt cus-icon py-1"></i></a>
      <button type="button" class="navbar-toggler border-0 px-2">
      </button>
    </div>  
</nav>


   
<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
    /*เมื่อปุ่มปิด หรือ เปิด เมนูด้านซ้ายถูกคลิก*/
    $(".close-l-sidenav,.open-l-sidenav").on("click",function(){
        var toggleWidth = ($(".l-sidenav").width()==0)?250:0;
        $(".l-sidenav").width(toggleWidth);
    });
});
</script>
</body>
</html>

<?php
  if (isset($_GET['logout'])) {
    echo "
    <script>
    Swal.fire({
      icon: 'warning',
      title: 'ออกจากระบบ',
      text: 'คุณต้องการออกจากระบบ',
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: 'ออกจากระบบ',
    }).then((result) => {
      if (result.value) {
        location.href='logout.php';
      } else {
        window.history.back();
      }
    })
    </script>";
  }?>