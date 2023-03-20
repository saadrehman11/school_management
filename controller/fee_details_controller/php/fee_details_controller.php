<?php
include '../../../includes/dbconnection.php';

$type = $_REQUEST['type'];

// load students
if($type=="101"){

    $st_name = $_POST['st_name'];
    $branch = $_POST['branch'];
    $flag = $_POST['flag'];
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
      <th scope="col">Details</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    
    $q = "SELECT * FROM `student` ";
    if(!empty($st_name) || !empty($branch)){
        $q .= " WHERE ";
        if(!empty($st_name) && !empty($branch)){
            $q .= " student_name LIKE '%$st_name%' AND `discipline` IN (SELECT `id` FROM `discipline` WHERE `branch` ='$branch') "; 
        }
        elseif(!empty($st_name) ){
            $q .= " student_name LIKE '%$st_name%' ";
        }
        elseif(!empty($branch) ){
            $q .= " `discipline` IN (SELECT `id` FROM `discipline` WHERE `branch` ='$branch') ";
        }
    }

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
              <p class="text-white bg-success text-sm p-1 text-center">Active</p>
            <?php
          }elseif($row['status'] == '2'){
            ?>
              <p class="text-white bg-danger text-sm p-1 text-center">InActive</p>
            <?php
          }
        ?>
        </td>
        
        <?php
        if($flag == '1'){
          ?>
          <td>
            <div>
            <button class="btn btn-sm btn-warning" onclick="see_remaining_fee_details(<?=$student_id?>)" data-bs-toggle="modal" data-bs-target="#submit_fee_modal">Submit Fee</button>
            </div>
          </td>
          <?php
        }
        else{
          ?>
          <td>
            <div>
              <a class="btn btn-primary btn-sm" data-bs-target="#student_row<?=$student_id?>" data-bs-toggle="collapse" href="#" onclick="see_details(<?=$student_id?>)"><i class="bi bi-clipboard-check"></i> Details</a>
            </div>
          </td>
          <?php
        }
        ?>
        
      </tr>

      <?php
      if($flag != '1'){
        ?>
        <tr>
        <td colspan="13">
          <div class="collapse" id="student_row<?=$student_id?>">
          </div>
        </td>
      </tr>
        <?php
      }
      ?>
      
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