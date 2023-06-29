<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $('Agenda').change(function() {
    var id_Agenda = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_Agenda,function:'Agenda'},
      success: function(data){
          $('#Agenda').html(data); 
          $('#Building').html(' '); 
          $('#Room').val(' ');  
      }
    });
  });
 
  $('#Building').change(function() {
    var id_Building = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_Building,function:'Building'},
      success: function(data){
          $('#Room').html(data);  
      }
    });
  });

</script>