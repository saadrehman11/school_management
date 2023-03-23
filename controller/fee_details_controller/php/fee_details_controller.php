<?php
include '../../../includes/dbconnection.php';

$type = $_REQUEST['type'];

// load students
if($type=="101"){

    $st_name = $_POST['st_name'];
    $batch = $_POST['batch'];
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];
    $discipline = $_POST['discipline'];
    $and_status = '0';
?>
<div class="table-responsive">
  <table class="table table-striped datatable " id="students_fee_table">
  <thead class="bg-dark text-white">
    <tr>
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
  <tbody>
    <?php
    
    $q = "SELECT * FROM `student`";
    if(!empty($st_name) || !empty($batch) || !empty($branch) || !empty($semester) || !empty($discipline)){ 
        $q .= " WHERE ";
        // if(!empty($st_name) && !empty($branch)){
        //     $q .= " student_name LIKE '%$st_name%' AND `discipline` IN (SELECT `id` FROM `discipline` WHERE `branch` ='$branch') "; 
        // }
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
        <td><?=$count?></td>
        <td><?=$student_id?></td>
        <td>
          <img src="../../<?=$row['picture_path']?>" height="45" width="45">
        </td>
        <td>
          <p class="text-sm"><?=$row['student_name']?></p></td>
        <td>
          <p class="text-sm"><?=$row['father_name']?></p>  
        </td>
        <td>
          <p class="text-sm"><?=$row['phone']?></p></td>
        <td>
          <p class="text-sm"><?=$row['batch']?></p>  
        </td>
        <td>
          <p class="text-sm"><?=$discipline_name?></p>
        </td>
        <td>
          <p class="text-sm"><?=$discipline_branch?></p>
        </td>
        <td>
          <p class="text-sm"><?=$discipline_program?></p>
        </td>
        <td>
          <p class="text-sm"><?=$semester?></p>
        </td>
        <td>
          <?php
          if($row['status'] == '1'){
            ?>
              <p class="text-white bg-success text-sm px-1 text-center">Active</p>
            <?php
          }elseif($row['status'] == '2'){
            ?>
              <p class="text-white bg-danger text-sm p-1 text-center">InActive</p>
            <?php
          }
        ?>
        </td>
      
          <td>
            <div class="p-1">
            <button class="btn btn-sm btn-warning" onclick="see_remaining_fee_details(<?=$student_id?>)" data-bs-toggle="modal" data-bs-target="#submit_fee_modal">Submit Fee</button>
            </div>
          
            <div class="p-1">
              <a class="btn btn-primary btn-sm" data-bs-target="#student_row<?=$student_id?>" data-bs-toggle="collapse" href="#" onclick="see_details(<?=$student_id?>)"><i class="bi bi-clipboard-check"></i> Details</a>
            </div>
          </td>
         
        
      </tr>

        <tr>
        <td colspan="13">
          <div class="collapse" id="student_row<?=$student_id?>">
          </div>
        </td>
      </tr>
       
      
      <?php
      $count++;
    }
    
    ?>
    
    
  </tbody>
</table>
</div>
    <?php
}

// load fee details
if($type=="102"){
  $student_id = $_POST['student_id'];
  ?>
  <div class="table-responsive">
  <table class="table" id="students_fee_detail_table">
  <thead class="bg-secondary text-white">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student ID</th>
      <th scope="col">Student Name</th>
      <th scope="col">Head of Account</th>
      <th scope="col">Semester</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Amount Paid</th>
    </tr>
  </thead>
  <tbody class="bg-white text-dark">
  <?php

  $ret=mysqli_query($con,"SELECT * FROM `fee_record` WHERE `student_id` = '$student_id' ORDER BY semester DESC"); 
  $count =1;
  while ($row=mysqli_fetch_array($ret)) 
  {
    $hoa_id = $row['hoa_id'];
    $check_student = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student` WHERE `id` = '$student_id'"));
    $StudentName = $check_student['student_name'];

    $check_hoa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `id` = '$hoa_id'"));
    $HOA_Name = $check_hoa['account_name'];
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$student_id?></td>
      <td><?=$StudentName?></td>
      <td><?=$HOA_Name?></td>
      <td><?=$row['semester']?></td>
      <td><?=$row['total_amount']?></td>
      <td><?=$row['amount_paid']?></td>
    </tr>
    <?php
    $count++;
  }
  ?>
   </tbody>
</table>
</div>
  <?php
}

// load remaining fee details
if($type=="103"){
  $student_id = $_POST['student_id'];
  ?>
  <div class="table-responsive">
  <table class="table" id="students_fee_detail_table">
  <thead class="bg-secondary text-white">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student ID</th>
      <th scope="col">Student Name</th>
      <th scope="col">Head of Account</th>
      <th scope="col">Semester</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Amount Paid</th>
      <th scope="col" class="w-auto">Paying Amount</th>
      <th scope="col">Submit</th>
    </tr>
  </thead>
  <tbody class="bg-white text-dark">
  <?php

  $ret=mysqli_query($con,"SELECT * FROM `fee_record` WHERE `student_id` = '$student_id' ORDER BY semester DESC"); 
  $count =1;
  while ($row=mysqli_fetch_array($ret)) 
  {
    $id = $row['id'];
    $hoa_id = $row['hoa_id'];
    $check_student = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student` WHERE `id` = '$student_id'"));
    $StudentName = $check_student['student_name'];

    $check_hoa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `id` = '$hoa_id'"));
    $HOA_Name = $check_hoa['account_name'];
    ?>
    <tr>
    
      <td>
        <p class="text-sm"><?=$count?></p>
        
      </td>
      <td>
        <p class="text-sm"><?=$student_id?></p>
      </td>
      <td>
        <p class="text-sm"><?=$StudentName?></p>
      </td>
      <td>
        <p class="text-sm"><?=$HOA_Name?></p>
      </td>
      <td>
        <p class="text-sm"><?=$row['semester']?></p>
      </td>
      <td>
      <p class="text-sm"> <?=$row['total_amount']?></p>
      </td>
      <td>
      <p class="text-sm"><?=$row['amount_paid']?></p>
      </td>
      <td style="width:10vw">
        <div >
          <input class="form-control" type="number" name="paying_amount_input<?=$id?>" id="paying_amount_input<?=$id?>" <?php if(intval($row['amount_paid']) >= intval($row['total_amount']) ){echo 'disabled';}?>>
        </div>
      </td>
      <td>
        <div>
          <button type="button" class="btn btn-sm btn-primary" onclick="submit_paying_amount(<?=$id?>)" <?php if(intval($row['amount_paid']) >= intval($row['total_amount']) ){echo 'disabled';}?>>Submit</button>
        </div>
      </td>
      
    </tr>
    <?php
    $count++;
  }
  ?>
   </tbody>
</table>
</div>
  <?php
}


if($type=="104"){

  $paying_amount_input = $_POST['paying_amount_input'];
  $fee_record_id = $_POST['fee_record_id'];

  $check_fee_record = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `fee_record` WHERE `id` = '$fee_record_id'"));
  $total_amount = $check_fee_record['total_amount'];
  $amount_paid = $check_fee_record['amount_paid'];
  $student_id = $check_fee_record['student_id'];

  if(!empty($paying_amount_input)){
    $final_amount = $paying_amount_input + $amount_paid;
    if(intval($final_amount) <= intval($total_amount)){
      $updatequery=mysqli_query($con, "UPDATE `fee_record` SET `amount_paid`='$final_amount' WHERE `id` = '$fee_record_id'");
      if($updatequery){
        echo json_encode(['status_Code'=>100,'msg'=>"Successfully Updated",'student_id'=>$student_id]);
      }
      else{
        echo json_encode(['status_Code'=>200,'msg'=>"Error updating Record"]);
      }
    }
    else{
      echo json_encode(['status_Code'=>302,'msg'=>"The Amount is exceeding the total amount"]);
    }
  }
  else{
    echo json_encode(['status_Code'=>301,'msg'=>"Entered Amount cannot be empty"]);
  }
}