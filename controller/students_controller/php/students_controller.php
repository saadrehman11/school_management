<?php
include '../../../includes/dbconnection.php';

$type = $_REQUEST['type'];

if($type=="101"){    

    date_default_timezone_set('Asia/Karachi');
    $date_and_time = date("Y-m-d H:i:s");
    $date_time_file_name = date("Y_m_d_h_i_s");
    $msg ='';
    $img_path ='';
    $file_Status_Code = '';
    if(!empty($_FILES['picture']['name'])){
        $target_dir = "../../../assets/images/profile_photo/";
        $img_path = "assets/images/profile_photo/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $msg .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg =  "Sorry, your file was not uploaded.";
            $file_Status_Code = 200;
        } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], ($target_dir.$date_time_file_name.'.'.$imageFileType))) {
            $file_Status_Code = 100;
            $msg .=  "The file ". htmlspecialchars( basename( $_FILES["picture"]["name"])). " has been uploaded.";
            $img_path = $img_path.$date_time_file_name.'.'.$imageFileType;
        } else {
            $msg .=  "Sorry, there was an error uploading your file.";
            $file_Status_Code = 200;
        }
        }
    }
    try{
        $stmt = $pconn->prepare("INSERT INTO `student`( `student_name`, `father_name`, `phone`, `batch`, `discipline`, `picture_path`, `created_on`) 
        VALUES  (:student_name, :father_name, :phone,:batch, :discipline, :picture_path, :created_on)");
        
        $stmt->bindParam(':student_name', $student_name);
        $stmt->bindParam(':father_name', $father_name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':batch', $batch);
        $stmt->bindParam(':discipline', $discipline);
        $stmt->bindParam(':picture_path', $img_path);
        $stmt->bindParam(':created_on', $date_and_time);
    
        // insert a row
        $student_name = $_POST['student_name'];
        $father_name = $_POST['father_name'];
        $phone = $_POST['phone'];
        $batch = $_POST['batch'];
        $discipline = $_POST['discipline'];
        
        if($stmt->execute()){
            $id = $pconn->lastInsertId();
            $semester = $_POST['semester'];
            $addsemester=mysqli_query($con, "INSERT INTO `student_semester`(`semester_number`, `student_id`, `created_on`) VALUES ('$semester','$id','$date_and_time')");

            $check_discipline = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `discipline` WHERE `id` = '$discipline'"));
            $program = $check_discipline['program'];
            if($program == "Diploma"){
                $p = "Diploma";
            }
            elseif($program == "BS"){
                $p = "BS Degree";   
            }
            elseif($program == "CAT-B"){
                $p = "CAT-B";   
            }
            elseif($program == "Nursing"){
                $p = "Nursing";   
            }
            $ret=mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `category` = '$p'"); 
            while ($row=mysqli_fetch_array($ret)) 
            {   
                $hoa_id = $row['id'];
                $amount = $row['amount'];
                $add_fee_record=mysqli_query($con, "INSERT INTO `fee_record`(`student_id`, `hoa_id`, `semester`, `total_amount`, `created_on`) VALUES ('$id','$hoa_id','$semester','$amount','$date_and_time')");
            }
            echo json_encode(['status_Code'=>100,'msg'=>'Success','file_Status_Code'=>$file_Status_Code,'file_msg'=>$msg]);
        }
    }
    catch(PDOException $e) {
        echo json_encode(['Status_Code'=>200,'msg'=>$e->getMessage(),'file_Status_Code'=>$file_Status_Code,'file_msg'=>$msg]);
    }
    
}


?>

