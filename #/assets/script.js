$(function(){
    var AgendaObject = $('#Agenda');
    var BuildingObject = $('#Building');
    var RoomObject = $('#Room');
    // on change province
    AgendaObject.on('change', function(){
    var AgendaId = $(this).val();
    BuildingObject.html('<option value="">เลือกตึก</option>');
    RoomObject.html('<option value="">เลือกห้อง</option>');
    $.get('get_Building.php?Agenda_id=' + AgendaId, function(data){
    var result = JSON.parse(data);
    $.each(result, function(index, item){
        BuildingObject.append(
    $('<option></option>').val(item.id).html(item.name_th)
    );
    });
    });
    });
    // on change amphure
    BuildingObject.on('change', function(){
    var BuildingId = $(this).val();
    RoomObject.html('<option value="">เลือกตำบล</option>');
    $.get('get_Room.php?Building_id=' + BuildingId, function(data){
    var result = JSON.parse(data);
    $.each(result, function(index, item){
    RoomObject.append(
    $('<option></option>').val(item.id).html(item.name_th)
    );
    });
    });
    });
    });