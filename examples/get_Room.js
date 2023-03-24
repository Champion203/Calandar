ระดับชั้น
<select name="group1" id="group1">
          <option value="">เลือก</option>
          <option value="1">สำนักงานเทคโนโลยีสารสนเทศเเละการสื่อสาร</option>
          <option value="2">กองบริหารศูนย์รังสิต</option>
</select>

 <select name="list1" id="list1">
          <option value="1">อาคารวิทยบริการ</option>
          <option value="2">อาคารปิยชาติ ชั้น7</option>
</select>
<select name="list2" id="list2">
          <option value="1">ห้องประชุม1 (25 ที่นั่ง)</option>
          <option value="2">ห้องประชุมสื่อฯ (10 ที่นั่ง)</option>
          <option value="3">ห้องสัมมนา (70 ที่นั่ง)</option>
          <option value="3">ห้องอบรมคอมพิวเตอร์ (60 ที่นั่ง)</option>
          <option value="3">Virtual Studio Room (0 ที่นั่ง)</option>
          <option value="3">ห้องบริการคอมพิวเตอร์ (35 ที่นั่ง)</option>
</select>
<select name="list3" id="list3">
          <option value="1">ม.1E</option>
          <option value="2">ม.2E</option>
          <option value="3">ม.3E</option>
</select>
$(document).ready(function(){
    $('#list1').hide();
    $('#list2').hide();
    $('#list3').hide();
    $("#group1").change(function(){
        var value = $("#group1 option:selected").val();
        if (value == "1"){
            $('#list1').show();
      $('#list2').hide();
      $('#list3').hide();
      if (value == "1"){
                    $('#list2').show();
          $('#list3').hide();
          }else {
            $('#list2').hide();
                        $('#list3').show();
         }
      }
    });
}); //End