<?php require('ConnectDatabase.php'); ?>
<!DOCTYPE html>
<meta charset="utf-8">
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
        $stmt = "SELECT * FROM Agenda";
        $query = sqlsrv_query($conn, $stmt);
    ?>
<div class="container">
  <h2>Form control: select option</h2>
  <form>
    <div class="form-group">
      <label for="sel1">หน่วยงาน:</label>
      <select class="form-control" name="Ref_Agenda_id" id="Agenda">
            <option value="" selected disabled>-กรุณาเลือกหน่วยงาน-</option>
             <?php while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ ?>
            <option value="<?=$result['ID']?>"><?=$result['Agenda']?></option>
            <?php } ?>
      </select>
      <br>
 
      <label for="sel1">ตึก:</label>
      <select class="form-control" name="Ref_Building_id" id="Building">
      </select>
      <br>
 
      <label for="sel2">ห้องประชุม:</label>
      <select class="form-control" name="Ref_Room_id" id="Room">
      </select>
       <br>
       <a href="https://devtai.com/?cat=38"> <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button></a>
    </div>
  </form>
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