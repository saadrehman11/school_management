<?php
include '../../../includes/dbconnection.php';
require_once '../../../assets/PHPExcel-1.8/Classes/PHPExcel.php';


$type = $_REQUEST['type'];

if($type=="101"){

print_r($_FILES);

$file_name = $_FILES['excel-file']['name'];
$file_tmp = $_FILES['excel-file']['tmp_name'];
// $excel = PHPExcel_IOFactory::load($file_tmp);

// Get the worksheet that contains the data
// $worksheet = $excel->getActiveSheet();

// // Find the column indexes of the static columns
// $column_indexes = array();
// foreach ($worksheet->getRowIterator() as $row) {
//     $cellIterator = $row->getCellIterator();
//     $cellIterator->setIterateOnlyExistingCells(false); 

//     foreach ($cellIterator as $cell) {
//         if (!is_null($cell)) {
//             $column_letter = $cell->getColumn();
//             $column_value = $cell->getValue();

//             if ($column_value == "Amount") {
//                 $column_indexes['amount'] = $column_letter;
//             } elseif ($column_value == "Total Paid") {
//                 $column_indexes['total_paid'] = $column_letter;
//                 break 2;
//             }
//         }
//     }
// }

// // Loop through each row of the worksheet, starting from row 3
// for ($row = 3; $row <= $worksheet->getHighestRow(); $row++) {

//     // Get the data from each cell in the row
//     $s_no = $worksheet->getCell('A'.$row)->getValue();
//     $name = $worksheet->getCell('B'.$row)->getValue();
//     $father_name = $worksheet->getCell('C'.$row)->getValue();
//     $technology = $worksheet->getCell('D'.$row)->getValue();
//     $particulars = $worksheet->getCell('E'.$row)->getValue();
//     $amount = $worksheet->getCell($column_indexes['amount'].$row)->getValue();

//     $dynamic_columns = array();
//     foreach ($worksheet->getColumnIterator($column_indexes['amount'], $column_indexes['total_paid']-1) as $column) {
//         $column_letter = $column->getColumnIndex();
//         $column_value = $worksheet->getCell($column_letter.$row)->getValue();
//         $dynamic_columns[] = $column_value;
//     }

//     $oct_20 = $worksheet->getCell($column_indexes['total_paid'].$row)->getValue();
//     $o_s = $worksheet->getCell($column_indexes['total_paid']+1 .$row)->getValue();
//     $prev_o_s = $worksheet->getCell($column_indexes['total_paid']+2 .$row)->getValue();
//     $net_o_s = $worksheet->getCell($column_indexes['total_paid']+3 .$row)->getValue();
//     $total_o_s = $worksheet->getCell($column_indexes['total_paid']+4 .$row)->getValue();
//     $remarks = $worksheet->getCell($column_indexes['total_paid']+5 .$row)->getValue();

//     echo "oct_20".$oct_20;
//     echo "o_s".$o_s;
//     echo "prev_o_s".$prev_o_s;
//     echo "total_o_s".$total_o_s;
//     echo "remarks".$remarks;
// }
}


date_default_timezone_set("Asia/Karachi");
$date_time = date('Y-m-d H:i:s');

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
include '../../../assets/PHPExcel-1.8/SimpleXLSX.php';

    $count=0;
     if ($xlsx = SimpleXLSX::parse($file_tmp)) {
        foreach ($xlsx->readRows() as $k => $r) {
            $count++;
            if ($k <= 16 || empty(array_filter($r))) continue; // skip first row
            // print_r($r);
            $label_task_number=mysqli_real_escape_string($con,$r[0]);
            $quality_inspection_task=mysqli_real_escape_string($con,$r[1]);
            $id_of_the_task=mysqli_real_escape_string($con,$r[2]);
            $task_belongs=mysqli_real_escape_string($con,$r[3]);
            $task_type=mysqli_real_escape_string($con,$r[4]);
            
            $effective_number_or_total=$r[5];
            
            $all_duration=$r[6];

            
            $state=$r[7];
            $audio_name=$r[8];
            $number_of_reworks=$r[9];
            
            $checked_modified_items=$r[10];

            
            $application_time=$r[11];
           
            $submission_time=$r[12];
           
            $working_time=$r[13];
            $operating_options=$r[14];
            
            
            // $rows = $xlsx->rows();
            // echo $row_count = count($rows);
            echo "<pre>";
            print_r($r);
        }
      
     }
   


?>