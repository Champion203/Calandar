<?php session_start();
require ('Header.html'); 
?>
<html>
  <head>
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="css/dasboard.css">
  <body>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/mdb.min.js"></script>

        <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#">Calendar Event</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
        aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fab fa-houzz"></i>หน้าแรก</a>
      </li>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href="AddEvent.php">
          <i class="fas fa-calendar-plus"></i>จองห้อง</a>
      </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <?php echo $_SESSION['displayname_th']; ?> </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
              <a class="dropdown-item" href="ads.php"><?php echo $_SESSION['displayname_th']; ?></a>
              <a class="dropdown-item" href="dasboard_user.php">ข้อมูลการใช้งาน</a>
              <a class="dropdown-item" href="navbar.php?logout='1'">ออกจากระบบ</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!--/.Navbar -->
  </body>
  </head>
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