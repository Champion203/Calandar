<?php
session_start();
require('ConnectDatabase.php');
require('pdf/fpdf.php');
// $username = $_SESSION['email'] ;

// $sql = "SELECT * FROM Admin WHERE Username LIKE '$username'";
// $params = array();
// $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
// $stmt = sqlsrv_query( $conn, $sql , $params, $options );
// $row_count = sqlsrv_num_rows( $stmt );
// if ($row_count === 0){  //check session
//     echo "
//       <script>
//       Swal.fire({
//           position: 'top-center',
//           icon: 'error',
//           title: 'ท่านไม่มีสิทธิ์เข้าถึงหน้านี้',
//           showConfirmButton: false,
//           timer: 800, });
//           setTimeout(function(){
//               window.location.href = 'index.php';
//            },1500);
//       </script>";
//     }

$id = $_GET['id'];
$stmt = "SELECT * FROM Reserve_Room WHERE ID = $id";
$query = sqlsrv_query($conn, $stmt);

$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
// echo $result["ID_Reserve"];
// echo $result["FullName"];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->AddFont('sarabun', '', 'THSarabun.php');
$pdf->Image('img/PDF.jpg', 0, 0, 210, 297);
$pdf->SetY(74);
$pdf->SetX(60);
$pdf->SetFont('sarabun', '', 20);
$pdf->SetFont('sarabun', '', 18);
$pdf->Cell(30, 20, iconv('utf-8', 'cp874', $result["FullName"]), 0, 0, 'L');

$pdf->SetY(79);
$pdf->SetX(125);
$pdf->Cell(5, 10, iconv('utf-8', 'cp874', $result["department"]), 0, 1, 'L');

$pdf->SetY(91);
$pdf->SetX(47);
$pdf->Cell(10, 10, iconv('utf-8', 'cp874', $result["organization"]), 0, 0, 'L');

$pdf->SetY(91);
$pdf->SetX(145);
$pdf->Cell(10, 10, iconv('utf-8', 'cp874', $result["email"]), 0, 0, 'L');

$pdf->SetY(103);
$pdf->SetX(73);
$pdf->Cell(50, 10, iconv('utf-8', 'cp874', $result["Name_Room"]), 0, 0, 'L');

$pdf->SetY(115);
$pdf->SetX(45);
$pdf->Cell(50, 10, iconv('utf-8', 'cp874', $result["Name_Building"]), 0, 0, 'L');

$start = str_replace("T", " ", $result['Start_Reserve']);
$end = str_replace("T", " ", $result['End_Reserve']);
$datestart = date_create("$start");
$dateend = date_create("$end");
$pdf->SetY(127);
$pdf->SetX(53);
$pdf->Cell(50, 10, iconv('utf-8', 'cp874', date_format($datestart, "d/m/Y เวลา H:i:s น.")), 0, 0, 'L');

$pdf->SetY(127);
$pdf->SetX(123);
$pdf->Cell(50, 10, iconv('utf-8', 'cp874', date_format($dateend, "d/m/Y เวลา H:i:s น.")), 0, 0, 'L');

$pdf->SetY(201.5);
$pdf->SetX(95);
$pdf->Cell(25, 10, iconv('utf-8', 'cp874', 'ลงชื่อ'), 0, 1, 'L');

$pdf->SetY(220);
$pdf->SetX(75);
$pdf->Cell(20, 10, iconv('utf-8', 'cp874', '.................................................'), 0, 0, 'L');

$pdf->SetY(230);
$pdf->SetX(75);
$pdf->Cell(20, 10, iconv('utf-8', 'cp874', '(.................................................)'), 0, 0, 'L');

$pdf->SetY(240);
$pdf->SetX(88);
$pdf->Cell(25, 10, iconv('utf-8', 'cp874', 'ผู้เข้ารับบริการ'), 0, 1, 'L');

$pdf->SetY(220);
$pdf->SetX(150);
$pdf->Cell(20, 10, iconv('utf-8', 'cp874', '.................................................'), 0, 0, 'L');

$pdf->SetY(230);
$pdf->SetX(150);
$pdf->Cell(20, 10, iconv('utf-8', 'cp874', '(.................................................)'), 0, 0, 'L');

$pdf->SetY(240);
$pdf->SetX(168);
$pdf->Cell(25, 10, iconv('utf-8', 'cp874', 'ผู้อนุมัติ'), 0, 1, 'L');

$pdf->Output();
?>