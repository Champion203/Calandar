<?php 
    session_start();
    require ('Header.html'); 
    require ('navbar.php');
    require('ConnectDatabase.php'); 

    if(isset($_POST["Ref_Room_id"])){
        $Room = $_POST["Ref_Room_id"];
        $time = $_POST["time"];
        $date = $_POST["booking_date"];
    }
    $sql1 = "SELECT * FROM Reserve_Room WHERE time LIKE 'all' AND Name_Room LIKE '%$Room%' AND Start_Reserve LIKE '%$date%' AND Status_Reserve != 'disapproval'";
    $params1 = array();
    $options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt1 = sqlsrv_query( $conn, $sql1 , $params1, $options1 );
    $row_count1 = sqlsrv_num_rows( $stmt1 );

    $sql2 = "SELECT * FROM Reserve_Room WHERE time LIKE '$time' AND Name_Room LIKE '%$Room%' AND Start_Reserve LIKE '%$date%'  AND Status_Reserve != 'disapproval'";
    $params2 = array();
    $options2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt2 = sqlsrv_query( $conn, $sql2 , $params2, $options2 );
    $row_count2 = sqlsrv_num_rows( $stmt2 );

    $sql3 = "SELECT * FROM Reserve_Room WHERE time LIKE 'morning' AND Name_Room LIKE '%$Room%' AND Start_Reserve LIKE '%$date%'  AND Status_Reserve != 'disapproval'";
    $params3 = array();
    $options3 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt3 = sqlsrv_query( $conn, $sql3 , $params3, $options3 );
    $row_count3 = sqlsrv_num_rows( $stmt3 );

    $sql4 = "SELECT * FROM Reserve_Room WHERE time LIKE 'afternoon' AND Name_Room LIKE '%$Room%' AND Start_Reserve LIKE '%$date%'  AND Status_Reserve != 'disapproval'";
    $params4 = array();
    $options4 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt4 = sqlsrv_query( $conn, $sql4 , $params4, $options4 );
    $row_count4 = sqlsrv_num_rows( $stmt4 );

    if($time == 'morning'){
        if($row_count1 >= 1){
            echo "
                <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'วันที่ดังกล่าวได้มีการจองแล้ว',
                    showConfirmButton: false,
                    timer: 1500, });
                    setTimeout(function(){
                        window.location.href = 'AddEvent.php';
                    },1500);
                </script>";
        } elseif ($row_count2 >= 1){
            echo "
                <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'วันที่ดังกล่าวได้มีการจองแล้ว',
                    showConfirmButton: false,
                    timer: 1500, });
                    setTimeout(function(){
                        window.location.href = 'AddEvent.php';
                    },1500);
                </script>";
        } else {
            require ('save_insert.php') ;
        }
    } elseif ($time == 'afternoon'){
        if($row_count1 >= 1){
            echo "
                <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'วันที่ดังกล่าวได้มีการจองแล้ว',
                    showConfirmButton: false,
                    timer: 1500, });
                    setTimeout(function(){
                        window.location.href = 'AddEvent.php';
                    },1500);
                </script>";
        } elseif ($row_count2 >= 1){
            echo "
                <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'วันที่ดังกล่าวได้มีการจองแล้ว',
                    showConfirmButton: false,
                    timer: 1500, });
                    setTimeout(function(){
                        window.location.href = 'AddEvent.php';
                    },1500);
                </script>";
        } else {
            require ('save_insert.php') ;
        }
    } elseif ($time == 'all'){
        if($row_count3 >= 1){
            echo "
                <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'วันที่ดังกล่าวได้มีการจองแล้ว',
                    showConfirmButton: false,
                    timer: 1500, });
                    setTimeout(function(){
                        window.location.href = 'AddEvent.php';
                    },1500);
                </script>";
        } elseif ($row_count4 >= 1){
            echo "
                <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'วันที่ดังกล่าวได้มีการจองแล้ว',
                    showConfirmButton: false,
                    timer: 1500, });
                    setTimeout(function(){
                        window.location.href = 'AddEvent.php';
                    },1500);
                </script>";
        } elseif ($row_count1 >= 1){
            echo "
                <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'วันที่ดังกล่าวได้มีการจองแล้ว',
                    showConfirmButton: false,
                    timer: 1500, });
                    setTimeout(function(){
                        window.location.href = 'AddEvent.php';
                    },1500);
                </script>";
        } else {
            require ('save_insert.php') ;
        }
    }

?>