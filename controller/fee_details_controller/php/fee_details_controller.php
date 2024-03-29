<?php
include '../../../includes/dbconnection.php';
 error_reporting(0); 
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
      if(!empty($check_discipline)){
        $discipline_name = $check_discipline['discipline_name'];
        $discipline_branch= $check_discipline['branch'];
        $discipline_program = $check_discipline['program'];
      }
      
      ?>
      <tr>
        <td><?=$count?></td>
        <td><?=$student_id?></td>
        <td>
          <?php
          if(!empty($check_student['picture_path'])){
            echo '<img src="../../'.$row['picture_path'].'" height="45" width="45">';
          }
          else{
            echo '<img src="../../assets/images/profile_photo/user-icon.webp" height="45" width="45">';
          }?>
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
              <p class="text-white bg-danger text-sm px-1 text-center">InActive</p>
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
  $sum_total = 0 ;
  $sum_paid = 0 ;
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

  $ret=mysqli_query($con,"SELECT * FROM `fee_record` WHERE `student_id` = '$student_id' ORDER BY id DESC"); 
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
      <td>
        <?php
          if($count == 1){
            ?>
            <p class="text-sm mb-0"><?=$student_id?></p>
            <?php
          }
          ?>
        </td>
        <td>
        <?php
          if($count == 1){
            ?>
            <p class="text-sm mb-0"><?=$StudentName?></p>
            <?php
          }
          ?>
          
        </td>
      <td><?=$HOA_Name?></td>
      <td><?=$row['semester']?></td>
      <td>
        <?php echo $row['total_amount'];
      $sum_total = $sum_total + $row['total_amount'];
        ?>
      </td>
      <td>
      <?php echo $row['amount_paid'];
      $sum_paid = $sum_paid + $row['amount_paid'];
        ?>  
      </td>
    </tr>
    <?php
    $count++;
  }
  ?>
  <tr>
    <td colspan="7">
      Total: <?=$sum_total?>
      <br>
      Total Paid: <?=$sum_paid?>
      <br>
      Total Remaining: <?=($sum_total-$sum_paid)?>
    </td>
  </tr>
   </tbody>
</table>
</div>
  <?php
}

// load remaining fee details
if($type=="103"){
  $student_id = $_POST['student_id'];
  $sum_total = 0 ;
  $sum_paid = 0 ;
  ?>
  <ul class="nav nav-tabs d-flex mb-2" id="myTabjustified" role="tablist">
    <li class="nav-item flex-fill" role="presentation">
      <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Fee with Head of Accounts</button>
    </li>
    <li class="nav-item flex-fill" role="presentation">
      <button class="nav-link w-100" id="total-tab" data-bs-toggle="tab" data-bs-target="#total-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">Semester wise Fee</button>
    </li>
  </ul>

  <div class="tab-content pt-2" id="myTabjustifiedContent">
    <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
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
        <th scope="col">Edit</th>
        <th scope="col" class="w-auto">Paying Amount</th>
        <th scope="col">Submit</th>
      </tr>
    </thead>
    <tbody class="bg-white text-dark">
    <?php

    $ret=mysqli_query($con,"SELECT * FROM `fee_record` WHERE `student_id` = '$student_id' ORDER BY id DESC"); 
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
          <p class="text-sm mb-0"><?=$count?></p>
        </td>
        <td>
        <?php
          if($count == 1){
            ?>
            <p class="text-sm mb-0"><?=$student_id?></p>
            <?php
          }
          ?>
        </td>
        <td>
        <?php
          if($count == 1){
            ?>
            <p class="text-sm mb-0"><?=$StudentName?></p>
            <?php
          }
          ?>
          
        </td>
        <td>
          <p class="text-sm mb-0"><?=$HOA_Name?></p>
        </td>
        <td>
          <p class="text-sm mb-0"><?=$row['semester']?></p>
        </td>
        <td>
          <?php echo '<p class="text-sm mb-0">'.$row['total_amount'].'</p>';
          $sum_total = $sum_total + $row['total_amount'];
          ?>
        </td>
        <td>
          <?php echo '<p class="text-sm mb-0">'.$row['amount_paid'].'</p>';
          $sum_paid = $sum_paid + $row['amount_paid'];
          ?>
        </td>
        <td>
          <button class="btn btn-info btn-sm text-white" onclick="edit_fee_detail('<?=$id?>','<?=$student_id?>')" data-bs-toggle="modal" data-bs-target="#edit_fee_modal">Edit</button>
        </td>
        <td style="width:10vw">
          <div >
            <input class="form-control py-0" type="number" name="paying_amount_input<?=$id?>" id="paying_amount_input<?=$id?>" <?php if(intval($row['amount_paid']) >= intval($row['total_amount']) ){echo 'disabled';}?>>
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
    <tr>
    <td colspan="9">
      Total: <?=$sum_total?>
      <br>
      Total Paid: <?=$sum_paid?>
      <br>
      Total Remaining: <?=($sum_total-$sum_paid)?>
    </td>
  </tr>
    </tbody>
  </table>
  </div>
    </div>
    <div class="tab-pane fade" id="total-justified" role="tabpanel" aria-labelledby="total-justified">
    <table class="table" id="students_fee_detail_table2">
      <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Student ID</th>
        <th scope="col">Student Name</th>
        <th scope="col">Semester</th>
        <th scope="col">Total Amount</th>
        <th scope="col">Amount Paid</th>
        <th scope="col" class="w-auto">Paying Amount</th>
        <th scope="col">Submit</th>
        </tr>
      </thead>
      <tbody>
      <?php

    $ret2=mysqli_query($con,"SELECT *,sum(`total_amount`) as total_amount_semester,sum(`amount_paid`) as total_paid_semester FROM `fee_record` WHERE `student_id` = '$student_id' GROUP BY semester"); 
    $counter =1;
    while ($row2=mysqli_fetch_array($ret2)) 
    {
      $id = $row2['id'];
      $hoa_id = $row2['hoa_id'];
      $check_student = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student` WHERE `id` = '$student_id'"));
      $StudentName = $check_student['student_name'];

      $check_hoa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `id` = '$hoa_id'"));
      $HOA_Name = $check_hoa['account_name'];
      ?>
      <tr>
        <td>
          <p class="text-sm mb-0"><?=$counter?></p>
        </td>
        <td>
          <?php
          if($counter == 1){
            ?>
            <p class="text-sm mb-0"><?=$student_id?></p>
            <?php
          }
          ?>
          
        </td>
        <td>
        <?php
          if($counter == 1){
            ?>
            <p class="text-sm mb-0"><?=$StudentName?></p>
            <?php
          }
          ?>
        </td>
        <td>
          <p class="text-sm mb-0"><?=$row2['semester']?></p>
        </td>
        <td>
        <p class="text-sm mb-0"> <?=$row2['total_amount_semester']?></p>
        </td>
        <td>
        <p class="text-sm mb-0"><?=$row2['total_paid_semester']?></p>
        </td>
        <td style="width:10vw">
          <div >
            <input class="form-control py-0" type="number" name="paying_amount_semester<?=$id?>" id="paying_amount_semester<?=$id?>" <?php if(intval($row2['total_paid_semester']) >= intval($row2['total_amount_semester']) ){echo 'disabled';}?>>
          </div>
        </td>
        <td>
          <div>
            <button type="button" class="btn btn-sm btn-primary" onclick="submit_semester_amount('<?=$row2['semester']?>','<?=$id?>','<?=$student_id?>')" <?php if(intval($row2['total_paid_semester']) >= intval($row2['total_amount_semester']) ){echo 'disabled';}?>>Submit</button>
          </div>
        </td>
        
      </tr>
      <?php
      $counter++;
    }
    ?>
        <tr>
    <td colspan="9">
      Total: <?=$sum_total?>
      <br>
      Total Paid: <?=$sum_paid?>
      <br>
      Total Remaining: <?=($sum_total-$sum_paid)?>
    </td>
  </tr>
      </tbody>
    </table>
    </div>
  </div>

  <!-- SELECT SUM(`total_amount`) FROM `fee_record` WHERE `student_id` = '9' AND `semester` = (SELECT MAX(`semester`) FROM `fee_record` WHERE `student_id` = '9') -->
  <!-- SELECT sum(`total_amount`),semester FROM `fee_record` WHERE `student_id` = '10' GROUP BY semester -->
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

// load outstanding fee
if($type=="105"){
  
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
  
  $q = "SELECT `student_id`, semester, SUM(total_amount) AS total_amount, SUM(amount_paid) AS amount_paid_per_semester
  FROM fee_record
  GROUP BY student_id
  HAVING SUM(amount_paid) < SUM(total_amount)";

  $ret=mysqli_query($con,$q); 
  $count = 1;
  while ($row=mysqli_fetch_array($ret)) 
  {
    $student_id = $row['student_id'];
    $check_student = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student` WHERE `id` = '$student_id'"));

    $discipline = $check_student['discipline'];
  
    $check_semester = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student_semester` WHERE `student_id` = '$student_id' ORDER BY created_on DESC LIMIT 1"));
    if(!empty($check_semester)){
      $semester = $check_semester['semester_number'];
    }
    else{
      $semester = NULL;
    }
      $check_discipline = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `discipline` WHERE `id` = '$discipline'"));
    
      if(!empty($check_discipline)){
        $discipline_name = $check_discipline['discipline_name'];
        $discipline_branch= $check_discipline['branch'];
        $discipline_program = $check_discipline['program'];
      }
    
    
    
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$student_id?></td>
      <td>
      <?php
          if(!empty($check_student['picture_path'])){
            echo '<img src="../../'.$check_student['picture_path'].'" height="45" width="45">';
          }
          else{
            echo '<img src="../../assets/images/profile_photo/user-icon.webp" height="45" width="45">';
          }?>
      </td>
      <td>
        <p class="text-sm w-25"><?=$check_student['student_name']?></p></td>
      <td>
        <p class="text-sm"><?=$check_student['father_name']?></p>  
      </td>
      <td>
        <p class="text-sm"><?=$check_student['phone']?></p></td>
      <td>
        <p class="text-sm"><?=$check_student['batch']?></p>  
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
        if($check_student['status'] == '1'){
          ?>
            <p class="text-white bg-success text-sm px-1 text-center">Active</p>
          <?php
        }elseif($check_student['status'] == '2'){
          ?>
            <p class="text-white bg-danger text-sm px-1 text-center">InActive</p>
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


// load paid fee
if($type=="106"){
 
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
    
    $q = "SELECT `student_id`, semester, SUM(total_amount) AS total_amount, SUM(amount_paid) AS amount_paid_per_semester
    FROM fee_record
    GROUP BY student_id
    HAVING SUM(amount_paid) >= SUM(total_amount)";
  
    $ret=mysqli_query($con,$q); 
    $count = 1;
    while ($row=mysqli_fetch_array($ret)) 
    {
      $student_id = $row['student_id'];
      $check_student = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student` WHERE `id` = '$student_id'"));
      $discipline = $check_student['discipline'];
      
      $check_semester = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student_semester` WHERE `student_id` = '$student_id' ORDER BY created_on DESC LIMIT 1"));
      if(!empty($check_semester)){
        $semester = $check_semester['semester_number'];
      }
      else{
        $semester = NULL;
      }
      
  
      $check_discipline = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `discipline` WHERE `id` = '$discipline'"));
      
      if(!empty($check_discipline)){
        $discipline_name = $check_discipline['discipline_name'];
        $discipline_branch= $check_discipline['branch'];
        $discipline_program = $check_discipline['program'];
      }
      
      ?>
      <tr>
        <td><?=$count?></td>
        <td><?=$student_id?></td>
        <td>
          <?php
          if(!empty($check_student['picture_path'])){
            echo '<img src="../../'.$check_student['picture_path'].'" height="45" width="45">';
          }
          else{
            echo '<img src="../../assets/images/profile_photo/user-icon.webp" height="45" width="45">';
          }?>
        </td>
        <td>
          <p class="text-sm"><?=$check_student['student_name']?></p></td>
        <td>
          <p class="text-sm"><?=$check_student['father_name']?></p>  
        </td>
        <td>
          <p class="text-sm"><?=$check_student['phone']?></p></td>
        <td>
          <p class="text-sm"><?=$check_student['batch']?></p>  
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
          if($check_student['status'] == '1'){
            ?>
              <p class="text-white bg-success text-sm px-1 text-center">Active</p>
            <?php
          }elseif($check_student['status'] == '2'){
            ?>
              <p class="text-white bg-danger text-sm px-1 text-center">InActive</p>
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


if($type=="107"){
  // print_r($_POST);
  $student_id = $_POST['student_id'];
  $semester = $_POST['semester'];
  $paying_amount_semester = $_POST['paying_amount_semester'];

  if(!empty($paying_amount_semester)){
    $amount_semester = mysqli_fetch_array(mysqli_query($con,"SELECT *,sum(`total_amount`) as total_amount_semester,sum(`amount_paid`) as total_paid_semester FROM `fee_record` WHERE `student_id` = '$student_id' AND semester ='$semester'"));

    $total_amount_semester = intval($amount_semester['total_amount_semester']);
    $total_paid_semester = intval($amount_semester['total_paid_semester']);
  
    $t_amount = intval($paying_amount_semester) + ($total_paid_semester) ;
  
    if($t_amount > $total_amount_semester){
      echo json_encode(['status_Code'=>303,'msg'=>"Entered Amount cannot be greater than total paid amount"]);
    }
    elseif($t_amount < $total_amount_semester){
      echo json_encode(['status_Code'=>302,'msg'=>"Entered Amount cannot be less than total paid amount"]);
    }
    elseif(intval($t_amount) == $total_amount_semester){
      $ret=mysqli_query($con,"SELECT * FROM `fee_record` WHERE `student_id` = '$student_id' AND `semester` = '$semester'"); 
      while ($row=mysqli_fetch_array($ret)) 
      {
        $id = $row['id'];
        $student_id = $row['student_id'];
        $total_amount = $row['total_amount'];
        $amount_paid = $row['amount_paid'];

        $updtquery=mysqli_query($con, "update fee_record set amount_paid='$total_amount' where id='$id'");
      }
      echo json_encode(['status_Code'=>100,'msg'=>"Entered Amount is paid"]);
    }
  }
  else{
    echo json_encode(['status_Code'=>301,'msg'=>"Entered Amount cannot be empty"]);
  }
  


}

// edit amount form
if($type=="108"){

  $fee_id = $_POST['row_id'];
  $student_id = $_POST['student_id'];

  $check_student_rec = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `student` WHERE `id` = '$student_id'"));

  $check_fee_rec = mysqli_fetch_array(mysqli_query($con,"SELECT *  FROM `fee_record` WHERE `id` = $fee_id AND student_id = '$student_id'"));

  ?>
  <form id="fee_edit_form<?=$fee_id?>">
  <div class="container">
    <div class="row">
      <div class="col-12 py-2">
        <div class="form-group">
          <b><label>Student Name: <?=$check_student_rec['student_name']?></label></b>
        </div>
      </div>
      <div class="col-12 col-md-6 py-2">
        <div class="form-group">
          <label for="total_amount">Total Amount:</label>
          <input type="number" class="form-control" name="total_amount" id="total_amount" value="<?=$check_fee_rec['total_amount']?>">
        </div>
      </div>
      <div class="col-12 col-md-6 py-2">
        <div class="form-group">
          <label for="paid_amount">Paid Amount:</label>
          <input type="number" class="form-control" name="paid_amount" id="paid_amount" value="<?=$check_fee_rec['amount_paid']?>">
        </div>
      </div>
      <div class="col-12 py-2">
      <button type="button" onclick="update_fee_values('<?=$fee_id?>')" class="btn btn-primary">Update</button>
      </div> 
    </div>
    
  </div>
  </form>
  <?php

}

// update fee values
if($type=="109"){

  // print_r($_POST);
  $total_amount = $_POST['total_amount'];
  $paid_amount = $_POST['paid_amount'];
  $fee_id = $_POST['fee_id'];

  $updt_query=mysqli_query($con, "UPDATE `fee_record` SET `total_amount`='$total_amount',`amount_paid`='$paid_amount' WHERE `id` = '$fee_id'");

  if($updt_query){
    echo json_encode(['status_Code'=>100,'msg'=>'Values Successfully updated']);
  }

}