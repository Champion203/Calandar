<?php 
require ('navbar.php');
require ('Header.html'); 
$min = date('Y-d-m H:i:s');
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
  <title>Bootstrap 5 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12">
            <form action="save_insert.php" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-12 col-sm-6 mb-2">
                <label for="sel1">เลือกห้อง </label>
                <select class="form-control" name="sel1" id="sel1" required>
                  <option>ห้องประชุม 1</option>
                  <option>ห้องประชุม 2</option>
                  <option>ห้องประชุม 3</option>
                </select>
              </div>
            <div class="col-12 col-sm-6 mb-2">
              <label for='start'>วันเวลาที่เริ่มต้น <font color='red'> * </font></label>
              <input type='datetime-local' name='booking_start_date' min='$min' id='start' class='form-control' required>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 mb-2">
              <label for='end'>วันเวลาที่สิ้นสุด</label>
              <font color='red'> * </font>
              <input type='datetime-local' name='booking_end_date' id='end' min='$min' class='form-control' required>
            </div>
              <div class="col-12 col-sm-6 mb-3" >
                <label for='end'>รายละเอียด</label>
                <font color='red'> * </font>
                <input type="text" name="detail" id='detail' class="form-control" required>
              </div>
            </div> 
            <div class="row">
            <div class="col-12 col-sm-6">
              <button type="summit" class="btn btn-success btn-block">เพิ่มกำหนดการ</button>
            </div>
            <div class="col-12 col-sm-6">
              <button type="button" onclick="javascript:window.history.back()" class="btn btn-secondary btn-block">ย้อนกลับ</button>
            </div>
      </form>
    </div>
</body>

</html>

