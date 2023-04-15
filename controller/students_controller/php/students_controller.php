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
            $ret=mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE (`category` = '$p' || `category` = 'General') AND `status` = '1'"); 
            while ($row=mysqli_fetch_array($ret)) 
            {   
                $hoa_id = $row['id'];
                $amount = $row['amount'];
                $add_fee_record=mysqli_query($con, "INSERT INTO `fee_record`(`student_id`, `hoa_id`, `semester`, `total_amount`, `created_on`) VALUES ('$id','$hoa_id','$semester','$amount','$date_and_time')");
            }
            $hostellite = $_POST['hostellite'];
            if($hostellite == '1'){
                $ret2=mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `category` = 'General_optional' AND `status` = '1'"); 
                while ($row2=mysqli_fetch_array($ret2)) 
                {   
                    $hoa_id = $row2['id'];
                    $amount = $row2['amount'];
                    $add_fee_record=mysqli_query($con, "INSERT INTO `fee_record`(`student_id`, `hoa_id`, `semester`, `total_amount`, `created_on`) VALUES ('$id','$hoa_id','$semester','$amount','$date_and_time')");
                }
            }
            echo json_encode(['status_Code'=>100,'msg'=>'Success','file_Status_Code'=>$file_Status_Code,'file_msg'=>$msg]);
        }
    }
    catch(PDOException $e) {
        echo json_encode(['Status_Code'=>200,'msg'=>$e->getMessage(),'file_Status_Code'=>$file_Status_Code,'file_msg'=>$msg]);
    }
    
}

if($type == "102"){
    $st_name = $_POST['st_name'];
    $batch = $_POST['batch'];
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];
    $discipline = $_POST['discipline'];
    $and_status = '0';
?>

  <table class="table table-striped " id="students_table">
  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">Select</th>
      <th scope="col">#</th>
      <th scope="col">Student ID</th>
      <th scope="col">Picture</th>
      <th scope="col">Student Name</th>
      <th scope="col">Father Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Batch</th>
      <th scope="col">Discipline</th>
      <th scope="col">Branch</th>
      <th scope="col">Program</th>
      <th scope="col">Semester</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <?php
    
    $q = "SELECT * FROM `student`";
    if(!empty($st_name) || !empty($batch) || !empty($branch) || !empty($semester) || !empty($discipline)){ 
        $q .= " WHERE ";
        if(!empty($st_name) ){
            $q .= " student_name LIKE '%$st_name%' ";
            $and_status = '1';
        }
        if(!empty($batch) ){
          if($and_status == '1'){
            $q .= " AND ";
          }
          $q .= " `batch` = '$batch' ";
          $and_status = '1';
        }
        if(!empty($branch) ){
            if($and_status == '1'){
              $q .= " AND ";
            }
            $q .= " `discipline` IN (SELECT `id` FROM `discipline` WHERE `branch` ='$branch') ";
            $and_status = '1';
        }
        if(!empty($semester) ){
            if($and_status == '1'){
              $q .= " AND ";
            }
            $q .= " `id` IN (SELECT `student_id` FROM `student_semester` WHERE `semester_number` = '$semester' AND `status` = '1') ";
            $and_status = '1';
        }
        if(!empty($discipline) ){
            if($and_status == '1'){
              $q .= " AND ";
            }
            $q .= " `discipline` = '$discipline' ";
            $and_status = '1';
        }
    }
    // echo "query ".$q ;
    // die();
    $ret=mysqli_query($con,$q); 
    $count = 1;
    while ($row=mysqli_fetch_array($ret)) 
    {
      $student_id = $row['id'];
      $discipline = $row['discipline'];
      $check_semester = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student_semester` WHERE `student_id` = '$student_id' ORDER BY created_on DESC LIMIT 1"));
      if(!empty($check_semester)){
        $semester = $check_semester['semester_number'];
      }
      else{
        $semester = NULL;
      }
      $check_discipline = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `discipline` WHERE `id` = '$discipline'"));
      $discipline_name = $check_discipline['discipline_name'];
      $discipline_branch= $check_discipline['branch'];
      $discipline_program = $check_discipline['program'];
      ?>
      <tr>
        <td><input type="checkbox" name="student_ids[]" id="student_ids"  value="<?=$student_id?>"></td>
        <td><?=$count?></td>
        <td>
          <p class="mb-0 text-sm"><?=$row['id']?></p>
        </td>
        <td>
          <?php 
          if(!empty($row['picture_path'])){
              ?>
              <img src="../../<?=$row['picture_path']?>" height="45" width="45">
              <?php
          }
          else{
            echo '<img src="../../assets/images/profile_photo/user-icon.webp" height="45" width="45">';
          }
          ?>
        </td>
        <td>
          <p class="mb-0 text-sm"><?=$row['student_name']?></p>
        </td>
        <td>
          <p class="mb-0 text-sm"><?=$row['father_name']?></p>  
        </td>
        <td>
          <p class="mb-0 text-sm"><?=$row['phone']?></p></td>
        <td>
          <p class="mb-0 text-sm"><?=$row['batch']?></p>  
        </td>
        <td>
          <p class="mb-0 text-sm"><?=$discipline_name?></p>
        </td>
        <td>
          <p class="mb-0 text-sm"><?=$discipline_branch?></p>
        </td>
        <td>
          <p class="mb-0 text-sm"><?=$discipline_program?></p>
        </td>
        <td>
          <p class="mb-0 text-sm"><?=$semester?></p>
        </td>
        <td>
          <?php
          if($row['status'] == '1'){
            ?>
              <p class="mb-0 text-white bg-success text-sm px-2 text-center">Active</p>
            <?php
          }elseif($row['status'] == '2'){
            ?>
              <p class="mb-0 text-white bg-danger text-sm px-2 text-center">InActive</p>
            <?php
          }
        ?>
        </td>
        <td>
          <div>
            <button class="btn btn-sm btn-warning" onclick="load_student_detail(<?=$student_id?>)" data-bs-toggle="modal" data-bs-target="#edit_student_modal">Edit</button>
            <?php 
            if($row['status'] == '1'){
              ?>
              <button class="btn btn-sm btn-danger" onclick="change_student_status(<?=$student_id?>,2)">Delete</button>
              <?php
            }
            else{
              ?>
              <button class="btn btn-sm btn-primary" onclick="change_student_status(<?=$student_id?>,1)">Undo Delete</button>
              <?php
            }
            ?>
            
          </div>
        </td>
        
      
      </tr>
      <?php
      $count++;
    }
    
    ?>
    
    
  </tbody>
  
</table>

<?php
}

// add hoa to selected students

if($type == "103"){
  // print_r($_POST);
  date_default_timezone_set('Asia/Karachi');
  $date_and_time = date("Y-m-d H:i:s");

  $hoa_id = $_POST['hoa_id'];
  $check_hoa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `id` ='$hoa_id'"));
  $get_amount = $check_hoa['amount'];
  if(!empty($_POST['student_ids'])){
    foreach($_POST['student_ids'] as $single_student_id){

      $check_semester = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student_semester` WHERE `student_id`='$single_student_id' AND `status` ='1' ORDER BY id DESC LIMIT 1"));
      $get_semester = $check_semester['semester_number'];

      $addFeeRecord=mysqli_query($con, "INSERT INTO `fee_record`( `student_id`, `hoa_id`, `semester`, `total_amount`, `created_on`) VALUES ('$single_student_id','$hoa_id','$get_semester','$get_amount','$date_and_time')");
    }
    echo json_encode(['Status_Code'=>100,'msg'=>'Successfully added Head of Account']);
  }
  else{
    echo json_encode(['Status_Code'=>300,'msg'=>'No students selected']);
  }

}


// promote selected students

if($type == "104"){
  // print_r($_POST);

  // die();
  date_default_timezone_set('Asia/Karachi');
  $date_and_time = date("Y-m-d H:i:s");


  if(!empty($_POST['student_ids'])){
    foreach($_POST['student_ids'] as $single_student_id){

      $check_semester = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student_semester` WHERE `student_id`='$single_student_id' AND `status` ='1' ORDER BY id DESC LIMIT 1"));
      $get_semester = $check_semester['semester_number'];

      $check_stud_discipline = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student` WHERE `id` = '$single_student_id' AND `status` = '1'"));
      $get_stud_discipline = $check_stud_discipline['discipline'];
      
      $check_discipline = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `discipline` WHERE `id` = '$get_stud_discipline' AND `status` = '1'"));
      $num_of_semesters = $check_discipline['num_of_semesters'];
      
      if(intval($num_of_semesters) > intval($get_semester)){
        $new_semester = (intval($get_semester))+1;
        $promoteSemester=mysqli_query($con, "INSERT INTO `student_semester`( `semester_number`, `student_id`, `created_on`) VALUES ('$new_semester','$single_student_id','$date_and_time')");

        foreach($_POST['hoa_id'] as $single_hoa_id){
          $check_hoa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `id` ='$single_hoa_id'"));
          $get_amount = $check_hoa['amount'];

          $addFeeRecord=mysqli_query($con, "INSERT INTO `fee_record`( `student_id`, `hoa_id`, `semester`, `total_amount`, `created_on`) VALUES ('$single_student_id','$single_hoa_id','$new_semester','$get_amount','$date_and_time')");
        }
      }
    }
    echo json_encode(['Status_Code'=>100,'msg'=>'Successfully added Head of Account']);
  }
  else{
    echo json_encode(['Status_Code'=>300,'msg'=>'No students selected']);
  }

}


// load student details for edit
if($type == "105"){

  $student_id = $_POST['student_id'];
  $check_student = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student` WHERE `id` = '$student_id'"));


?>
     <form id="edit_student_form"  method="post" action="#" onsubmit="edit_student_detail();return false">
        <div class="row mt-3">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header py-0">
                <h3 class="card-title text-center">General</h3>
                <input type="hidden" id="student_id" name="student_id" value="<?=$student_id?>">
              </div>
              <div class="card-body">
                <div class="form-group py-2">
                  <label for="student_name">Student Name</label>
                  <input type="text" id="student_name"  name="student_name" class="form-control" value="<?=$check_student['student_name']?>" required>
                </div>
                <div class="form-group py-2">
                  <label for="father_name">Father's Name</label>
                  <input type="text" id="father_name" name="father_name" class="form-control" value="<?=$check_student['father_name']?>" required>
                </div>
                <div class="form-group py-2">
                  <label for="phone">Phone #</label>
                  <input type="text" id="phone" name="phone" class="form-control" value="<?=$check_student['phone']?>">
                </div>
                <div class="form-group py-2">
                  <label for="batch">Batch</label>
                  <input type="text" id="batch" name="batch" class="form-control" value="<?=$check_student['batch']?>" required>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="d-flex justify-content-center">
            <input type="submit" class="btn btn-success float-right">
          </div>
        </div>
      </form>
<?php
}

// edit student details
if($type == "106"){

  // print_r($_POST);
  $student_id = $_POST['student_id'];
  $student_name = $_POST['student_name'];
  $father_name = $_POST['father_name'];
  $phone = $_POST['phone'];
  $batch = $_POST['batch'];
  $Up_query=mysqli_query($con, "UPDATE `student` SET `student_name`='$student_name',`father_name`='$father_name',`phone`='$phone',`batch`='$batch' WHERE `id` = '$student_id'");

  if($Up_query){
    echo json_encode(['Status_Code'=>100]);
  }
  else{
    echo json_encode(['Status_Code'=>200]);
  }


}


// deleting student
if($type=="107"){
  $student_id = $_POST['student_id'];
  $status = $_POST['status'];
  $updatequery=mysqli_query($con, "UPDATE `student` SET `status`='$status' WHERE `id` = '$student_id'");

  if($updatequery){
      echo json_encode(['status_Code'=>100]);
  }
  else{
      echo json_encode(['status_Code'=>200]);
  }
}


?>

