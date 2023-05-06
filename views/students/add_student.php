<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  

<main id="main" class="main">
<div class="container pt-0 pb-2">

    <form id="new_student_form"  method="post" action="#" onsubmit="add_student_db();return false">
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header pb-0">
              <h3 class="card-title text-center py-0">General</h3>
            </div>
            <div class="card-body">
              <div class="row">
              <div class="form-group py-2">
                <label for="student_name">Student Name</label>
                <input type="text" id="student_name"  name="student_name" class="form-control" required>
              </div>
              <div class="form-group py-2">
                <label for="father_name">Father's Name</label>
                <input type="text" id="father_name" name="father_name" class="form-control" required>
              </div>
              <div class="form-group py-2 col-12 col-md-6">
                <label for="phone">Phone #</label>
                <input type="text" id="phone" name="phone" class="form-control">
              </div>
              <div class="form-group py-2 col-12 col-md-6">
                <label for="batch">Batch</label>
                <input type="text" id="batch" name="batch" class="form-control" required>
              </div>
              <div class="form-group py-2 col-12 col-md-6">
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
              <div class="form-group py-2 ">
                <label for="picture">Need Hostel:</label>
                <div class="row">
                  <div class="col-12 col-md-6">
                    <input type="radio" id="hostellite_yes" name="hostellite" class="custom-control-input" value="1">
                    <label for="hostellite_yes" class="custom-control-label">Yes</label>
                  </div>
                  <div class="col-12 col-md-6">
                    <input type="radio" id="hostellite_no" name="hostellite" class="custom-control-input" value="2" checked>
                    <label for="hostellite_no" class="custom-control-label">No</label>
                  </div>
                </div>
              </div>
              <div class="form-group py-2">
                <label for="picture">Need Transport:</label>
                <div class="row">
                  <div class="col-12 col-md-6">
                    <input type="radio" id="transport_yes" name="transport" class="custom-control-input" value="1">
                    <label for="transport_yes" class="custom-control-label">Yes</label>
                  </div>
                  <div class="col-12 col-md-6">
                    <input type="radio" id="transport_no" name="transport" class="custom-control-input" value="2" checked>
                    <label for="transport_no" class="custom-control-label">No</label>
                  </div>
                </div>
              </div>
              </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header pb-0">
              <h3 class="card-title text-center py-0">Discipline</h3>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-12 d-flex justify-content-center bg-primary text-white "><label class="p-2">NIHMS</label></div>
                    <?php
                    $ret=mysqli_query($con,"SELECT * FROM `discipline` WHERE `status` = '1' AND `branch` ='nihms'"); 
                    while ($row=mysqli_fetch_array($ret)) 
                    {
                        ?>
                        
                        <div class="col-12 col-md-6 form-group py-2">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" onchange="populate_hoa_div(this.value)" type="radio" id="discipline<?=$row['id']?>" name="discipline" value="<?=$row['id']?>" required>
                                <label for="discipline<?=$row['id']?>" class="custom-control-label"><?=$row['discipline_name']?> <b>(<?=$row['program']?>)</b> </label>
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
                        <div class="col-12 col-md-6 form-group py-2">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" onchange="populate_hoa_div(this.value)" type="radio" id="discipline<?=$row['id']?>" name="discipline" value="<?=$row['id']?>" required>
                                <label for="discipline<?=$row['id']?>" class="custom-control-label"><?=$row['discipline_name']?><b>(<?=$row['program']?>)</b> </label>
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
      <div class="row card py-2 col-12" id="hoa_div"></div>
      <div class="row">
        <div class="col-12">
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
