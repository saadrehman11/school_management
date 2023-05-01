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
    $flag = 0;
     if ($xlsx = SimpleXLSX::parse($file_tmp)) {
        foreach ($xlsx->readRows() as $k => $r) {
            $count++;
            if ($k <= 173 || empty(array_filter($r))) continue; // skip first row
            $sr=mysqli_real_escape_string($con,$r[0]);
            $name=mysqli_real_escape_string($con,$r[1]);
            $father_name=mysqli_real_escape_string($con,$r[2]);
            $discipline=mysqli_real_escape_string($con,$r[3]);
            $hoa=mysqli_real_escape_string($con,$r[4]);
            $amount=$r[5];
            
            $date1=$r[6];
            $date2=$r[7];
            $date3=$r[8];
            $date4=$r[9];
            $date5=$r[10];
            $date6=$r[11];
            $date7=$r[12];
            $date8=$r[13];
            $date9=$r[14];
            $date10=$r[15];
            $date11=$r[16];
            $date12=$r[17];
            $date13=$r[18];

            $total_paid=$r[19];
            $outstanding=$r[20];
            $prev_outstanding=$r[21];
            $net_outstanding=$r[22];
            $total_outstanding=$r[23];

            echo " ".$name;
            echo " ".$father_name;
            echo " ".$discipline;
            echo " ".$hoa;
            echo " ".$amount;
            echo " ".$date1;
            echo " ".$date2;
            echo " ".$date3;
            echo " ".$date4;
            echo " ".$date5;
            echo " ".$date6;
            echo " ".$date7;
            echo " ".$date8;
            echo " ".$date9;
            echo " ".$date10;
            echo " ".$date11;
            echo " ".$date12;
            echo " ".$date13;
            echo " ".$total_paid;
            
            die();
            if($flag == 0){
                $addstudent=mysqli_query($con, "INSERT INTO `student`( `student_name`, `father_name`, `batch`, `discipline`, `status`, `created_on`) 
                VALUES ($name','$father_name','8','4','1','$date_time')");
                $lastId=$con->insert_id;

                $addsemester=mysqli_query($con, "INSERT INTO `student_semester`(`semester_number`, `student_id`, `status`, `created_on`) VALUES ('1','$lastId','1','$date_time')");

                //remove die and this part needs to be completed
            }
            
            if($hoa == 'Others'){
                $flag = 0;
            }else{
                $flag = 1;
            }

            // $rows = $xlsx->rows();
            // echo $row_count = count($rows);

            echo " k is ".$k;
            
            // echo "<pre>";
            // print_r($r);
      
        }
      
     }
   


?>