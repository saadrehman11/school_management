<?php
include '../../../includes/dbconnection.php';

$type = $_REQUEST['type'];

if($type=="101"){

    $st_name = $_POST['st_name'];
    $branch = $_POST['branch'];
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
        <td>
          <div>
            <button class="btn btn-sm btn-primary" onclick="see_details(<?=$student_id?>)" type="button" data-toggle="collapse" data-target="#student_row<?=$student_id?>" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-clipboard-check"></i> Details</button>
          </div>
        </td>
        
      
      </tr>
      <tr>
        <div class="collapse" id="student_row<?=$student_id?>">
            <p>test</p>
        </div>
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