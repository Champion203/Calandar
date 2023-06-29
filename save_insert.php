
<?php
    session_start();
    require ('Header.html'); 
    require ('navbar.php');
    require('ConnectDatabase.php'); 
	$sql = "INSERT INTO Reserve_Room (ID_Reserve, FullName, department, organization, email, Name_Room, Name_Building, Start_Reserve, End_Reserve, time, Status_Reserve, Phone)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $Status = "wait";
    function random_strings($length_of_string) 
    { 
    $str= '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    //คำสั่งจัดเรียงลำดับตัวอักษรในข้อความแบบสุ่ม
    $str = str_shuffle($str);
    //ทำการตัด string ตามจำนวนที่ใส่เข้ามา
    $resultChar = substr($str, 0, $length_of_string); 
    return $resultChar;
    }
    
    if ($_POST["Ref_Building_id"] == "1"){
        $Building_id = "อาคารวิทยบริการ";
    }
    elseif ($_POST["Ref_Building_id"] == "2"){
        $Building_id = "อาคารปิยชาติ ชั้น7";
    }
    elseif ($_POST["Ref_Building_id"] == "3"){
        $Building_id = "อาคารเรียนรวมและปฎิบัติการรวม ชั้น2";
    }
    elseif ($_POST["Ref_Building_id"] == "4"){
        $Building_id = "อาคารเรียนรวมและปฎิบัติการรวม";
    }
    elseif ($_POST["Ref_Building_id"] == "5"){
        $Building_id = "สำนักงานอธิการบดี (รังสิต) ชั้น2";
    }
    elseif ($_POST["Ref_Building_id"] == "6"){
        $Building_id = "อาคารบโดมบริหาร (รังสิต) ชั้น3";
    }
    elseif ($_POST["Ref_Building_id"] == "7"){
        $Building_id = "อาคารปิยชาติ ชั้น2";
    }
    elseif ($_POST["Ref_Building_id"] == "8"){
        $Building_id = "อาคารราขสุดา ชั้น3";
    }
    elseif ($_POST["Ref_Building_id"] == "9"){
        $Building_id = "อาคารเรียนรวมและปฎิบัติการรวม ชั้น2";
    }
    elseif ($_POST["Ref_Building_id"] == "10"){
        $Building_id = "อาคารเรียนรวมและปฎิบัติการรวม ชั้น4";
    }
    elseif ($_POST["Ref_Building_id"] == "11"){
        $Building_id = "อาคารอเนกประสงค์ 3 (ท่าพระจันทร์)";
    }
    elseif ($_POST["Ref_Building_id"] == "12"){
        $Building_id = "คณะนิติศาสตร์";
    }

    if(isset($_POST["booking_date"])){
        $date = $_POST["booking_date"];
        if ($_POST["time"] == "morning"){
            $start = "08:00";
            $end = "12:00";
            $datestart = "$date $start";
            $dateend = "$date $end";
        }
        elseif ($_POST["time"] == "afternoon"){
            $start = "13:00";
            $end = "16:30";
            $datestart = "$date $start";
            $dateend = "$date $end";
        }
        elseif ($_POST["time"] == "all"){
            $start = "08:00";
            $end = "16:30";
            $datestart = "$date $start";
            $dateend = "$date $end";
        }
    }

    if(isset( $_POST["booking_date"])){
        $params = array(random_strings(6), $_SESSION['displayname_th'], $_SESSION['department'], $_SESSION['organization'], $_SESSION['email'], 
        $_POST["Ref_Room_id"], $Building_id, $datestart, $dateend, $_POST["time"], $Status, $_POST["Phone"]);
        $stmt = sqlsrv_query( $conn, $sql, $params);
    }
	if( $stmt === false ) {
		 die( print_r( sqlsrv_errors(), true));
	}
	else
	{
        echo "
        <script>
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'บันทึกสำเร็จ',
            showConfirmButton: false,
            timer: 1500, });
            setTimeout(function(){
                window.location.href = 'index.php';
             },1500);
        </script>";
	}
	sqlsrv_close($conn);
?>