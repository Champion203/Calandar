<?php 
session_start();
require ('Header.html'); 
if (!$_SESSION["displayname_th"]){
  require ('unnavbar.php');
} else {
  require ('menu.php');
}
require('resource.php'); 
?>
<!DOCTYPE html>
<html>
<head>
<title>ระบบจองห้องประชุมออนไลน์</title> 
<meta charset='utf-8' />
<link href='packages/core/main.css' rel='stylesheet' />
<link href='packages/daygrid/main.css' rel='stylesheet' />
<link href='packages/timegrid/main.css' rel='stylesheet' />
<link href='packages/list/main.css' rel='stylesheet' />
<script src='packages/core/main.js'></script>
<script src='packages/core/locales-all.js'></script>
<script src='packages/interaction/main.js'></script>
<script src='packages/daygrid/main.js'></script>
<script src='packages/timegrid/main.js'></script>
<script src='packages/list/main.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'th';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');
 
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      defaultDate: '<?php echo date('Y-m-d');?>',
      locale: initialLocaleCode,
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      eventLimit: true, // allow "more" link when too many events

      events:  
      <?php 
      echo json_encode($events2,JSON_UNESCAPED_UNICODE); 
      // echo json_encode($events2)
      ?>,
});

    calendar.render();
  });

</script>
<style>

  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #top {
    background: #eee;
    border-bottom: 1px solid #ddd;
    padding: 0 10px;
    line-height: 40px;
    font-size: 12px;
  }

  #calendar {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 10px;
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

  div.relative {
   position: relative;
   width: 400px;
   height: 200px;
   border: 3px solid rgb(0, 0, 0);
}
div.absolute {
   position: absolute;
   top: 100px;
   right: 0;
   width: 300px;
   height: 120px;
   border: 3px solid rgb(0, 0, 0);
}

#presentation:hover{
  box-shadow: 0 12px 28px -5px rgba(0,0,0,0.13);
  transition: all 0.3s;
  transform: translateZ(10px);
}

#floating-button{
  width: 55px;
  height: 4S00px;
  border-radius: 50%;
  background: #db4437;
  position: fixed;
  bottom: 30px;
  right: 30px;
  cursor: pointer;
  box-shadow: 0px 2px 10px rgba(0,0,0,0.2);
}

.letter{
  font-size: 23px;
  font-family: 'Roboto';
  color: white;
  position: absolute;
  left: 0;
  right: 0;
  margin: 0;
  top: 0;
  bottom: 0;
  text-align: center;
  line-height: 40px;
}

.reminder{
  position: absolute;
  left: 0;
  right: 0;
  margin: auto;
  top: 0;
  bottom: 0;
  line-height: 40px;
}

.profile{
  border-radius: 50%;
  width: 40px;
  position: absolute;
  top: 0;
  bottom: 0;
  margin: auto;
  right: 20px;
}
</style>
</head>
<body>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- OneTrust Cookies Consent Notice start for tu.ac.th -->
<script type="text/javascript" src="https://cdn-apac.onetrust.com/consent/7dbccbf7-21b3-4ce1-93a9-9c2783ada201/OtAutoBlock.js" ></script>
<script src="https://cdn-apac.onetrust.com/scripttemplates/otSDKStub.js" data-document-language="true" type="text/javascript" charset="UTF-8" data-domain-script="7dbccbf7-21b3-4ce1-93a9-9c2783ada201" ></script>
<script type="text/javascript">
function OptanonWrapper() { }
</script>
<!-- OneTrust Cookies Consent Notice end for tu.ac.th -->
  <div class="container-fluid">
	<div class="row">
  <div class="col-md-12" >
      <img src="img/TRAINING.jpg"  style="width:100%;"> <hr>
  <div id='script-warning'>
		This page should be running from a webserver, to allow fetching from the <code>json/</code> directory.
	</div>
  <div class="row">
  <div class="col-md-12" style="width:100%;">
  <div class="card">
      <div class="card-body">
      <div class="row">
      <div class="col-12 col-sm-3">
      <form action="Event.php" method="POST" enctype="multipart/form-data">
            <label for="sel1">หน่วยงานที่รับผิดชอบ</label>
              <select class="form-control" name="Ref_Agenda_id" id="Agenda" required>
                    <option value="" selected disabled>-กรุณาเลือกหน่วยงาน-</option>
                    <?php while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ ?>
                    <option value="<?=$result['ID']?>"><?=$result['Agenda']?></option>
                    <?php } ?>
              </select>
            </div>
            <div class="col-12 col-sm-3 ">
              <label for="sel1">ตึก</label>
              <select class="form-control" name="Ref_Building_id" id="Building" required>
              </select>
          </div> 
            <div class="col-12 col-sm-3">
            <label for="sel2">ห้องประชุม</label>
            <select class="form-control" name="Ref_Room_id" id="Room" required> 
            </select>
            </div> 
            <div class="col-12 col-sm-1">
            <label for="sel2">จองห้อง</label>
              <button type="summit" class="form-control btn btn-success">จอง</button>
            </div>
            <div class="col-12 col-sm-1">
            <label for="sel2">ล้าง</label>
              <a href="index.php" class="form-control btn btn-danger">ล้าง</a>
            </div>
          </div> </form> <hr>

  <div class="container-fluid">
  <div class="card">
      <div class="card-body">
      <div class="row">
		<div class="col-12 col-sm-12">
			<div id='calendar'></div>
    </div>
    <!-- <div class="absolute"> คำแนะนำ <br>
      - สีเหลือง หมายถึง สถานะรอการอนุมัติ <br>
      - สีเขียว หมายถึง สถานะอนุมัติแล้ว  <br>    
      - จองล่วงหน้า 5 วัน และล่วงหน้าไม่เกิน 30 วัน <br>
      - ระยะเวลาอนุมัติ 5 วันทำการ
    </div> -->
</div>
</div>
<div id="container-floating">
  <div id="floating-button">
  <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal"><i class="material-icons">help</i></button>
  </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">เงื่อนไขการใช้งาน</h4>
        </div>
        <div class="modal-body">
          <p align="left">      
            1. ป้ายสีเหลือง หมายถึง สถานะรอการอนุมัติ <br>
            2. ป้ายสีเขียว หมายถึง สถานะอนุมัติแล้ว  <br>    
            3. จองล่วงหน้า 5 วัน และล่วงหน้าไม่เกิน 30 วัน <br>
            4. ระยะเวลาอนุมัติ 5 วันทำการ <br>
            5. กรณียกเลิกต้องล่วงหน้า 3 วันก่อนถึงวันใช้งาน <br>
            6. เมื่อจองแล้วไม่มาใช้งานเกิน 2 ครั้งจะถูกแบนไม่ให้ใช้งาน
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#Agenda').change(function() {
    var ID_Agenda = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {ID:ID_Agenda,function:'Agenda'},
      success: function(data){
        console.log(data)
          $('#Building').html(data); 
      }
    });
  });
 
  $('#Building').change(function() {
    var ID_Building = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {ID:ID_Building,function:'Building'},
      success: function(data){
        console.log(data)
          $('#Room').html(data); 
      }
    });
  });
</script>

<?php
  if (isset($_GET['help'])) {
    echo "
    <script>
    Swal.fire({
      position : 'center-end',
      title: 'HELP',
      text: '1.สีเหลือง หมายถึง สถานะรอการอนุมัติ',
      confirmButtonText: 'ฉันเข้าใจเเล้ว',
    }).then((result) => {
      if (result.value) {
        location.href='index.php';
      }
    })
    </script>";
  }?>