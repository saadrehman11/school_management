<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  
<main id="main" class="main">
<div class="container-fluid">

<div class="table-responsive">
  <table class="table table-striped datatable " id="hoa_table">
  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Amount</th>
      <th scope="col">Action</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $ret=mysqli_query($con,"SELECT * FROM `head_of_accounts` "); 
    $count = 1;
    while ($row=mysqli_fetch_array($ret)) 
    {
      $hoa_id = $row['id'];
      
      ?>
      <tr>
        <td><?=$count?></td>
        <td>
          <p class="text-sm mb-0"><?=$row['account_name']?></p></td>
        <td>
          <p class="text-sm mb-0"><?=$row['category']?></p>  
        </td>
        <td>
          <p class="text-sm"><?=$row['amount']?></p></td>
        <td>
          <div>
            <button class="btn btn-sm btn-warning" onclick="edit_student_detail(<?=$student_id?>)" data-bs-toggle="modal" data-bs-target="#edit_hoa_modal"><i class="bi bi-pencil-square"></i></button>
            <button class="btn btn-sm btn-danger" onclick="delete_student(<?=$student_id?>)"><i class="bi bi-person-x-fill"></i></button>
          </div>
        </td>
        <td>
          <?php
          if($row['status'] == '1'){
            ?>
              <p class="text-white bg-success text-sm p-1 text-center mb-0">Active</p>
            <?php
          }elseif($row['status'] == '2'){
            ?>
              <p class="text-white bg-danger text-sm p-1 text-center mb-0">InActive</p>
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

<!-- Edit Student Modal -->
<div class="modal fade" id="edit_hoa_modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
 
      <div class="modal-body">
      <div>

      <form id="edit_student_form"  method="post" action="#" onsubmit="edit_student_detail();return false">
        <div class="row mt-3">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header py-0">
                <h3 class="card-title text-center">General</h3>
              </div>
              <div class="card-body">
                <div class="form-group py-2">
                  <label for="student_name">Student Name</label>
                  <input type="text" id="student_name"  name="student_name" class="form-control" required>
                </div>
                <div class="form-group py-2">
                  <label for="father_name">Father's Name</label>
                  <input type="text" id="father_name" name="father_name" class="form-control" required>
                </div>
                <div class="form-group py-2">
                  <label for="phone">Phone #</label>
                  <input type="text" id="phone" name="phone" class="form-control">
                </div>
                <div class="form-group py-2">
                  <label for="batch">Batch</label>
                  <input type="text" id="batch" name="batch" class="form-control" required>
                </div>
                <div class="form-group py-2">
                  <label for="semester">Semester</label>
                  <select id="semester" name="semester" class="form-control custom-select" >
                    <option selected disabled>Select Semester</option>
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
                    <option value="5">5th</option>
                    <option value="6">6th</option>
                    <option value="7">7th</option>
                    <option value="8">8th</option>
                  </select>
                </div>
                <div class="form-group py-2">
                  <label for="picture">Picture</label>
                  <input type="file" id="picture" name="picture" class="form-control">
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card card-secondary">
              <div class="card-header py-0">
                <h3 class="card-title text-center">Discipline</h3>
              </div>
              <div class="card-body">
                  <div class="row mt-3">
                      <div class="col-12 d-flex justify-content-center bg-primary text-white "><label class="p-2">NIHMS</label></div>
                      <?php
                      $ret=mysqli_query($con,"SELECT * FROM `discipline` WHERE `status` = '1' AND `branch` ='nihms'"); 
                      while ($row=mysqli_fetch_array($ret)) 
                      {
                          ?>
                          
                          <div class="col-12 col-md-6 form-group py-3">
                              <div class="custom-control custom-radio">
                                  <input class="custom-control-input" type="radio" id="discipline<?=$row['id']?>" name="discipline" value="<?=$row['id']?>" required>
                                  <label for="discipline<?=$row['id']?>" class="custom-control-label"><?=$row['discipline_name']?> (<?=$row['program']?>)</label>
                              </div>
                          </div>
                          <?php

                      }
                      ?>
                  </div>
                  <div class="row">
                  <div class="col-12 d-flex justify-content-center bg-primary text-white "><label class="p-2">NCN</label></div>
                      <?php
                      $ret=mysqli_query($con,"SELECT * FROM `discipline` WHERE `status` = '1' AND `branch` ='ncn'"); 
                      while ($row=mysqli_fetch_array($ret)) 
                      {
                          ?>
                          <div class="col-12 col-md-6 form-group py-3">
                              <div class="custom-control custom-radio">
                                  <input class="custom-control-input" type="radio" id="discipline<?=$row['id']?>" name="discipline" value="<?=$row['id']?>" required>
                                  <label for="discipline<?=$row['id']?>" class="custom-control-label"><?=$row['discipline_name']?> (<?=$row['program']?>)</label>
                              </div>
                          </div>
                          <?php
                      }
                  ?>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <input type="submit" class="btn btn-success float-right">
          </div>
        </div>
      </form>
</div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Student Modal-->
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/head_of_accounts_controller/js/hoa_controller.js"></script>
