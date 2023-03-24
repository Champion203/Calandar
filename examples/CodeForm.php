<?php
require('ConnectDatabase.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>select by.devtai.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    $sql_Room = "SELECT * FROM Room";
    $query = sqlsrv_query($conn, $sql_Room);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)
?>

<div class="container">
  <form>
    <div class="form-group">
      <label for="sel1">หน่วยงาน:</label>
      <select class="form-control" name="Agenda" id="Agenda">
            <option value="" selected disabled>-กรุณาเลือกหน่วยงาน-</option>
             <?php foreach ($result as $value) { ?>
            <option value="<?=$value['ID']?>"><?=$value['Agenda']?></option>
            <?php } ?>
      </select>
      <br>

      <label for="sel1">ตึก:</label>
      <select class="form-control" name="Building" id="Building">
      </select>
      <br>

      <label for="sel1">ที่นั่ง:</label>
      <select class="form-control" name="Seat" id="Seat">
      </select>
       <br>

      <label for="sel1">ห้องประชุม:</label>
       <input type="text" name="Room" id="Room" class="form-control">
          <br>
        <a href="https://devtai.com/?cat=38"> <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button></a>
    </div>
  </form>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('#provinces').change(function() {
    var id_province = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_province,function:'provinces'},
      success: function(data){
          $('#Agenda').html(data); 
          $('#Building').html(' '); 
          $('#Seat').val(' ');  
          $('#Room').val(' '); 
      }
    });
  });

  $('#Building').change(function() {
    var id_amphures = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_Building,function:'Building'},
      success: function(data){
          $('#Building').html(data);  
      }
    });
  });

   $('#Seat').change(function() {
    var id_Seat= $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_Seat,function:'Seat'},
      success: function(data){
          $('#Seat').val(data)
      }
    });
  
  });
</script>