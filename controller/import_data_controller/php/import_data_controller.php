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
    $flag = 1;
    $student_count = 0;
    $student_id = 0;
    
    $degree = "diploma";
     if ($xlsx = SimpleXLSX::parse($file_tmp)) {
        foreach ($xlsx->readRows() as $k => $r) {
            $hoa_id ="0";
            $count++;
            if ($k <= 1 ) continue; // skip first row
            if(empty(array_filter($r))){
                echo "student_count ".$student_count;
                // echo "breaking k is ".$k;
                break;
            }
            // echo "<pre>";
            // print_r($r);
            // die(); 
            $sr=trim($r[0]);
            $n = $r[1];
            $name=trim(preg_replace('/[^a-zA-Z]+$/', '', $n));
            if(!empty($n)){
                $flag = 0;
            }
            $father_name=trim($r[2]);
            $discipline=trim($r[3]);
            $hoa=trim($r[4]);
            $amount=trim($r[5]);
            
            
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
            // $date14=$r[19];

            $total_paid=$r[22];
            // $outstanding=$r[20];
            // $prev_outstanding=$r[21];
            // $net_outstanding=$r[22];
            // $total_outstanding=$r[23];

            // echo $name . " ";
            // echo $n . "\n";
            
            // echo " ".$father_name;
            // echo " ".$discipline;
            // echo " ".$hoa. "\n";
            // echo " ".$amount;
            // echo " ".$date1;
            // echo " ".$date2;
            // echo " ".$date3;
            // echo " ".$date4;
            // echo " ".$date5;
            // echo " ".$date6;
            // echo " ".$date7;
            // echo " ".$date8;
            // echo " ".$date9;
            // echo " ".$date10;
            // echo " ".$date11;
            // echo " ".$date12;
            // echo " ".$date13;   
            // echo " ".$date14;    
            // echo " ".$total_paid;
            
            // die();
            
            $batch = 18;
            $semester = '4';

            if($degree == "BS"){

                if($discipline =="MLT"){
                    $discipline = '5';
                }
                elseif($discipline =="DEN"){
                    $discipline = '4';
                }
                elseif($discipline =="HT"){
                    $discipline = '6';
                }
                elseif($discipline =="ANT"){
                    $discipline = '2';
                }
                elseif($discipline =="SUR"){
                    $discipline = '3';
                }
                elseif($discipline =="RAD"){
                    $discipline = '1';
                }
                
                if($flag == 0){

                    if($semester == '1'){
                        $addstudent=mysqli_query($con, "INSERT INTO `student`( `student_name`, `father_name`, `batch`, `discipline`, `status`, `created_on`) VALUES ('$name','$father_name','$batch','$discipline','1','$date_time')");
                        $lastId=$con->insert_id;
                        $student_id = $lastId;
                    }
                    else{
                        $student_id = NULL;
                        
                        $q = "SELECT * FROM `student` WHERE `student_name` = '$name' AND father_name= '$father_name'";
                        // echo $q." ";
                        $check_dublicate = mysqli_fetch_array(mysqli_query($con,$q));
                        if(!empty($check_dublicate['id'])){ 
                            
                            $student_count++;
                            // echo $student_count ."\n";
                            $student_id = $check_dublicate['id'];
                            // echo " ".$student_id . " " .$name. " \n";
                        }
                        echo $student_count. " ". $student_id ."\n";
                    }
                    
                    if(!empty($student_id)){
                        $addsemester=mysqli_query($con, "INSERT INTO `student_semester`(`semester_number`, `student_id`, `status`, `created_on`) VALUES ('$semester','$student_id','1','$date_time')");
                    }
                    
                    
                }
                
                if($hoa == "Others"){
                    $flag = 0;
                    $hoa_id = "32";
                }elseif($hoa == "Admission"){
                    $flag = 1;
                    $hoa_id = "1";
                }elseif($hoa == "Tuition"){
                    $flag = 1;
                    $hoa_id = "6";
                }elseif($hoa == "Security"){
                    $flag = 1;
                    $hoa_id = "31";
                }elseif($hoa == "ID+Overall"){
                    $flag = 1;
                    $hoa_id = "30";
                }elseif($hoa == "Hostel"){
                    $flag = 1;
                    $hoa_id = "2";
                }elseif($hoa == "Degree Fee"){
                    $flag = 1;
                    $hoa_id = "9";
                }elseif($hoa == "Exam Fee"){
                    $flag = 1;
                    $hoa_id = "10";
                }elseif($hoa == "Registration"){
                    $flag = 1;
                    $hoa_id = "11";
                }elseif($hoa == "Retention"){
                    $flag = 1;
                    $hoa_id = "12";
                }elseif($hoa == "Clinical Charges"){
                    $flag = 1;
                    $hoa_id = "8";
                }
        }
        elseif($degree == "diploma"){
            if($discipline =="DEN"){
                $discipline = '10';
            }
            elseif($discipline =="CAR"){
                $discipline = '17';
            }
            elseif($discipline =="HT"){
                $discipline = '9';
            }
            elseif($discipline =="PT"){
                $discipline = '11';
            }
            elseif($discipline =="ANT"){
                $discipline = '16';
            }
            elseif($discipline =="RAD"){
                $discipline = '12';
            }
            elseif($discipline =="SUR"){
                $discipline = '18';
            }
            elseif($discipline =="PHY"){
                $discipline = '14';
            }
            
            if($flag == 0){
                // $student_count++;
                if($semester == '1'){
                    $addstudent=mysqli_query($con, "INSERT INTO `student`( `student_name`, `father_name`, `batch`, `discipline`, `status`, `created_on`) VALUES ('$name','$father_name','$batch','$discipline','1','$date_time')");
                    $lastId=$con->insert_id;
                    $student_id = $lastId;
                    $student_count++;
                    echo $student_count. " ";
                }
                else{
                    $student_id = NULL;
                    
                    $q = "SELECT * FROM `student` WHERE `student_name` = '$name' AND father_name= '$father_name'";
                    $check_dublicate = mysqli_fetch_array(mysqli_query($con,$q));
                    if(!empty($check_dublicate['id'])){ 
                        $student_count++;
                        $student_id = $check_dublicate['id'];
                        // echo " ".$student_id . " " .$name. " \n";
                    }
                    echo $student_count. ", student_id ". $student_id . ", ". $name."\n";
                }
                
                if(!empty($student_id)){
                    $addsemester=mysqli_query($con, "INSERT INTO `student_semester`(`semester_number`, `student_id`, `status`, `created_on`) VALUES ('$semester','$student_id','1','$date_time')");
                }
                 
            }
            
            if($hoa == "Admission"){
                
                $hoa_id = "1";
            }elseif($hoa == "Tuitions"){
                
                $hoa_id = "6";
            }elseif($hoa == "Exam"){
                
                $hoa_id = "16";
            }elseif($hoa == "Security"){
                
                $hoa_id = "31";
            }elseif($hoa == "Hostel"){
               
                $hoa_id = "2";
            }elseif($hoa == "Clinical Training"){
               
                $hoa_id = "14";
            }elseif($hoa == "Registration"){
               
                $hoa_id = "18";
            }elseif($hoa == "ID + Overall"){
                
                $hoa_id = "30";
            }elseif($hoa == "Grace Marks Fee"){
                
                $hoa_id = "17";
            }elseif($hoa == "UFM Fee"){
                
                $hoa_id = "19";
            }elseif($hoa == "Tuitions - 2nd"){
                
                $hoa_id = "222";
            }
        }


            if(!empty($amount)){
                if(!empty($student_id)){
                    $addfee_detail=mysqli_query($con, "INSERT INTO `fee_record`(`student_id`, `hoa_id`, `semester`, `total_amount`, `amount_paid`, `created_on`) VALUES ('$student_id','$hoa_id','$semester','$amount','$total_paid','$date_time')");
                }
                
            }
            

            // $rows = $xlsx->rows();
            // echo $row_count = count($rows);

            // echo " k is ".$k;
            
            
            $flag = 1;
        }
      
     }
   


?>