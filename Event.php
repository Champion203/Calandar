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
    background-image: url('img/J4x.gif');
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
</style>
</head>
<body>
<!-- OneTrust Cookies Consent Notice start for tu.ac.th -->
<script type="text/javascript" src="https://cdn-apac.onetrust.com/consent/7dbccbf7-21b3-4ce1-93a9-9c2783ada201/OtAutoBlock.js" ></script>
<script src="https://cdn-apac.onetrust.com/scripttemplates/otSDKStub.js" data-document-language="true" type="text/javascript" charset="UTF-8" data-domain-script="7dbccbf7-21b3-4ce1-93a9-9c2783ada201" ></script>
<script type="text/javascript">
function OptanonWrapper() { }
</script>
<!-- OneTrust Cookies Consent Notice end for tu.ac.th -->
  </div>  
  <div class="container-fluid">
	<div class="row">
  <div class="col-md-12" style="width:100%;">
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
            <label for="sel1">หน่วยงานที่รับผิดชอบ</label>
              <select class="form-control" name="Ref_Agenda_id" id="Agenda" required>
                    <option value="" selected disabled>-กรุณาเลือกหน่วยงาน-</option>
                    <?php while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ ?>
                    <option value="<?=$result['ID']?>"><?=$result['Agenda']?></option>
                    <?php } ?>
              </select>
            </div>
            <div class="col-12 col-sm-3 ">
            <form action="Event.php" method="POST" enctype="multipart/form-data">
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
          <label for="sel2">ค้นหา</label>
              <button type="summit" class="form-control btn btn-success">ค้นหา</button>
            </div>
            <div class="col-12 col-sm-1">
            <label for="sel2">ยกเลิก</label>
              <a href="index.php" class="form-control btn btn-danger">ยกเลิก</a>
            </div>
          </div> </form> <hr>

  <div class="container-fluid">
  <div class="card">
      <div class="card-body">
      <form action="checkQ.php" method="POST" enctype="multipart/form-data">
      <div class="row">
		<div class="col-12 col-sm-8">
			<div id='calendar'></div>
		</div> 
            <div class="col-12 col-sm-4 mb-2">
              <label for='end'>ชื่อ-นามสกุล ผู้จอง</label>
              <input type='text' name='Name' id='Name' value='<?php echo $_SESSION['displayname_th']; ?>' class='form-control' disabled>
              <input type='text' name='department' id='department' value='<?php echo $_SESSION['department']; ?>' class='form-control' hidden>
              <label for='end'>หน่วยงาน</label>
              <input type='text' name='organization' id='organization' value='<?php echo $_SESSION['organization']; ?>' class='form-control' disabled>
              <label for='end'>อีเมล์</label>
              <input type='text' name='email' id='email' value='<?php echo $_SESSION['email']; ?>' class='form-control' disabled>
              <input type='text' name='Ref_Building_id' id='Building' value='<?php echo $_POST['Ref_Building_id']; ?>' class='form-control' hidden>
              <label for='end'>ห้อง</label>
              <input type='text' name='Ref_Room_id' id='Room' value='<?php echo $_POST['Ref_Room_id']; ?>' class='form-control' readonly>
              <label for='end'>เบอร์ติดต่อ</label>
              <font color='red'> * </font>
              <input type='text' name='Phone' id='Phone' class='form-control' required>
              <label for='end'>วันที่เข้ารับบริการ จองล่วง5วัน</label>
              <font color='red'> * </font>
              <?php $timestamp = (time()+ 86400 * 5);?>
              <?php $timestampmax = (time()+ 86400 * 30);?>
              <input type='date' name='booking_date' id='date' min='<?php echo date('Y-m-d' , $timestamp);?>' max='<?php echo date("Y-m-d", $timestampmax);?>' class='form-control' required>
              <label for='end'>ช่วงเวลาที่เข้ารับบริการ</label>
                <font color='red'> * </font>
                <select class="form-control" name="time" id="time" required>
                  <option value="morning">เช้า (08.30-12.00 น.)</option>
                  <option value="afternoon">บ่าย (13.00-16.30 น.)</option>
                  <option value="all">ทั้งวัน (08.30-16.30 น.)</option>
                </select> <br>
              <div class="d-grid gap-2 col-12">
                <button type="summit" class="btn btn-success btn-block">จองห้อง</button>
              </div> <br>
              <div class="d-grid gap-2 col-12">
                <a href="index.php" class="btn btn-Danger btn-block">หน้าแรก</a>
              </div>
            </div></div>
        </form>
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