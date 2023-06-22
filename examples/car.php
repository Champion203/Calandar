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
?>
<style>

body {
  background-image: url('pic_ocean.jpg');
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
<div class="container-fluid">
      <div class="row" >
      <div class="col-md-12" style="width:100%;">
      <div class="card">
      <div class="card-body">
      <div class=" bg-Dark text-white" role="alert">
        <h3 class="text-center" >ระบบการจองใช้รถยนต์หน่วยงาน</h3> </div>
      </div> </div> <br>

            <form action="save_insefrt.php" method="post" enctype="multipart/form-data">
            <div class="row" >
            <div class="col-12 col-sm-4 mb-2">
            <div class="card">
            <div class="card-body">
              <label for='uber'>คนขับ : นายทศพร ยั่งยืน</label><br>
              <input type='text' name='number' id='number' value='ป้ายทะเบียนรถ : ศว 8493' class='form-control' disabled><br>
              <img src="img/car1.png" alt="Italian Trulli" style="width:100%;">
              <button type="summit" class="btn btn-success btn-block">จอง</button>
            </div></div></div>

            <form action="save_insert.php" method="post" enctype="multipart/form-data">
            <div class="col-12 col-sm-4 mb-2">
            <div class="card">
            <div class="card-body">
              <label for='uber'>คนขับ : นายทศพร ยั่งยืน</label><br>
              <input type='text' name='number' id='number' value='ป้ายทะเบียนรถ : ฉน 4344' class='form-control' disabled><br>
              <img src="img/car1.png" alt="Italian Trulli" style="width:100%;">
              <button type="summit" class="btn btn-success btn-block">จอง</button>
            </div></div></div>

            <form action="save_insert.php" method="post" enctype="multipart/form-data">
            <div class="col-12 col-sm-4 mb-2">
            <div class="card">
            <div class="card-body">
              <label for='uber'>คนขับ : นายทศพร ยั่งยืน</label><br>
              <input type='text' name='number' id='number' value='ป้ายทะเบียนรถ : กก 5555' class='form-control' disabled><br>
              <img src="img/car1.png" alt="Italian Trulli" style="width:100%;">
              <button type="summit" class="btn btn-success btn-block">จอง</button>
            </div></div></div>

            <form action="save_insert.php" method="post" enctype="multipart/form-data">
            <div class="row" >
            <div class="col-12 col-sm-4 mb-2">
            <div class="card">
            <div class="card-body">
              <label for='uber'>คนขับ : นายทศพร ยั่งยืน</label><br>
              <input type='text' name='number' id='number' value='ป้ายทะเบียนรถ : ศว 8493' class='form-control' disabled><br>
              <img src="img/car1.png" alt="Italian Trulli" style="width:100%;">
              <button type="summit" class="btn btn-success btn-block">จอง</button>
            </div></div></div>

            <form action="save_insert.php" method="post" enctype="multipart/form-data">
            <div class="col-12 col-sm-4 mb-2">
            <div class="card">
            <div class="card-body">
              <label for='uber'>คนขับ : นายทศพร ยั่งยืน</label><br>
              <input type='text' name='number' id='number' value='ป้ายทะเบียนรถ : ฉน 4344' class='form-control' disabled><br>
              <img src="img/car1.png" alt="Italian Trulli" style="width:100%;">
              <button type="summit" class="btn btn-success btn-block">จอง</button>
            </div></div></div>

            <form action="save_insert.php" method="post" enctype="multipart/form-data">
            <div class="col-12 col-sm-4 mb-2">
            <div class="card">
            <div class="card-body">
              <label for='uber'>คนขับ : นายทศพร ยั่งยืน</label><br>
              <input type='text' name='number' id='number' value='ป้ายทะเบียนรถ : กก 5555' class='form-control' disabled><br>
              <img src="img/car1.png" alt="Italian Trulli" style="width:100%;">
              <button type="summit" class="btn btn-success btn-block">จอง</button>
            </div></div></div>

            <form action="save_insert.php" method="post" enctype="multipart/form-data">
            <div class="row" >
            <div class="col-12 col-sm-4 mb-2">
            <div class="card">
            <div class="card-body">
              <label for='uber'>คนขับ : นายทศพร ยั่งยืน</label><br>
              <input type='text' name='number' id='number' value='ป้ายทะเบียนรถ : ศว 8493' class='form-control' disabled><br>
              <img src="img/car1.png" alt="Italian Trulli" style="width:100%;">
              <button type="summit" class="btn btn-success btn-block">จอง</button>
            </div></div></div>

            <form action="save_insert.php" method="post" enctype="multipart/form-data">
            <div class="col-12 col-sm-4 mb-2">
            <div class="card">
            <div class="card-body">
              <label for='uber'>คนขับ : นายทศพร ยั่งยืน</label><br>
              <input type='text' name='number' id='number' value='ป้ายทะเบียนรถ : ฉน 4344' class='form-control' disabled><br>
              <img src="img/car1.png" alt="Italian Trulli" style="width:100%;">
              <button type="summit" class="btn btn-success btn-block">จอง</button>
            </div></div></div>

            <form action="save_insert.php" method="post" enctype="multipart/form-data">
            <div class="col-12 col-sm-4 mb-2">
            <div class="card">
            <div class="card-body">
              <label for='uber'>คนขับ : นายทศพร ยั่งยืน</label><br>
              <input type='text' name='number' id='number' value='ป้ายทะเบียนรถ : กก 5555' class='form-control' disabled><br>
              <img src="img/car1.png" alt="Italian Trulli" style="width:100%;">
              <button type="summit" class="btn btn-success btn-block">จอง</button>
            </div></div></div>
</form>
</body>
</html>