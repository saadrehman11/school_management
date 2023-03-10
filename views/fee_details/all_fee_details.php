<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  
<main id="main" class="main">
<div class="container-fluid" id="main_table_div">

<div class="table-responsive">
  <table class="table table-striped datatable " id="students_fee_table">
  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Picture</th>
      <th scope="col">Student Name</th>
      <th scope="col">Father Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Batch</th>
      <th scope="col">Discipline</th>
      <th scope="col">Branch</th>
      <th scope="col">Program</th>
      <th scope="col">Semester</th>
      <th scope="col">Action</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $ret=mysqli_query($con,"SELECT * FROM `student` "); 
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
          <div>
            <button class="btn btn-sm btn-warning" onclick="edit_student_detail(<?=$student_id?>)" data-bs-toggle="modal" data-bs-target="#edit_student_modal"><i class="bi bi-pencil-square"></i></button>
            <button class="btn btn-sm btn-danger" onclick="delete_student(<?=$student_id?>)"><i class="bi bi-person-x-fill"></i></button>
          </div>
        </td>
        <td>
          <?php
          if($row['status'] == '1'){
            ?>
              <p class="text-white bg-success text-sm p-2 text-center">Active</p>
            <?php
          }elseif($row['status'] == '2'){
            ?>
              <p class="text-white bg-danger text-sm p-2 text-center">InActive</p>
            <?php
          }
        ?>
        </td>
      
      </tr>
      <?php
      $count++;
    }
    
    ?>
    
    
  </tbody>
</table>
</div>


</div>
</main>



<!-- Edit Student Modal-->
<?php
include '../../includes/footer.php';
?>  

<script src="../../controller/fee_details_controller/js/fee_details_controller.js"></script>
