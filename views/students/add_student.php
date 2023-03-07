<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  

<main id="main" class="main">
<div class="container py-2">

    <form id="new_student_form"  method="post" action="#" onsubmit="add_student_db();return false">
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
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
            <div class="card-header">
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
</main>
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/students_controller/js/students_controller.js"></script>
