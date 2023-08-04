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
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  left: 120px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}
.active {
  background-color: green;
  color: white;
}

    
    </style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a class="nav-link active" href="index.php">หน้าแรก</a>
  <button class="dropdown-btn">เมนู 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
  <a class="nav-link" href="dasboard_user.php">ข้อมูลการจองส่วนตัว</a>
  <a class="nav-link" href="AddEvent.php">จองห้อง</a>
  </div>
  <button class="dropdown-btn">เมนูแอดมิน
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
  <a class="nav-link" href="dashboardAdmin.php">จัดการ</a>
  <a class="nav-link" href="EventAdmin.php">จองห้อง</a>
  <a class="nav-link" href="AddAdmin.php">เพิ่มแอดมิน</a>
  <a class="nav-link" href="baned.php">ระงับการใช้งานผู้ใช้</a>
  </div>
  <a class="nav-link active" href="sidebar.php?logout='1'">ออกจากระบบ</a>
</div>

  
<!-- ส่วนของการใช้งาน navbar-->
 <nav class="navbar navbar-dark bg-dark navbar-fixed-top">
<!-- ปุมด้านซ้าย แสดงเมนู-->
  <button class="navbar-toggler border-0 px-0 open-l-sidenav"  type="button">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; MENU</span>
  </button> 
<!-- ปุมด้านขวา แสดงเมนู  -->
    <div class="btn-group">
    <a href="index.php" class="btn btn-primary"><i class="fas fa-home cus-icon py-1"></i></a>
      <button type="button" class="navbar-toggler border-0 px-2">
      </button>
      <a href="sidebar.php?logout='1'" class="btn btn-Danger"><i class="fas fa-sign-out-alt cus-icon py-1"></i></a>
      <button type="button" class="navbar-toggler border-0 px-2">
      </button>
    </div>  
</nav>


<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
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