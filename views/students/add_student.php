<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  

<div class="container py-2">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student Add</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <form id="new_student_form"  method="post" action="#" onsubmit="add_student_db();return false">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="student_name">Student Name</label>
                <input type="text" id="student_name" class="form-control">
              </div>
              <div class="form-group">
                <label for="father_name">Father's Name</label>
                <input type="text" id="father_name" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone">Phone #</label>
                <input type="text" id="phone" class="form-control">
              </div>
              <div class="form-group">
                <label for="batch">Batch</label>
                <input type="text" id="batch" class="form-control">
              </div>
              <div class="form-group">
                <label for="semester">Semester</label>
                <select id="inputStatus" class="form-control custom-select">
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
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Discipline</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center"><label class="bg-primary text-white p-2">NIHMS</label></div>
                    <?php
                    $ret=mysqli_query($con,"SELECT * FROM `discipline` WHERE `status` = '1' AND `branch` ='nihms'"); 
                    while ($row=mysqli_fetch_array($ret)) 
                    {
                        ?>
                        
                        <div class="col-12 col-md-6 form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio<?=$row['id']?>" name="customRadio" value="<?=$row['id']?>">
                                <label for="customRadio<?=$row['id']?>" class="custom-control-label"><?=$row['discipline_name']?></label>
                            </div>
                        </div>
                        <?php

                    }
                    ?>
                </div>
                <div class="row">
                <div class="col-12 d-flex justify-content-center"><label class="bg-primary text-white p-2">NCN</label></div>
                    <?php
                    $ret=mysqli_query($con,"SELECT * FROM `discipline` WHERE `status` = '1' AND `branch` ='ncn'"); 
                    while ($row=mysqli_fetch_array($ret)) 
                    {
                        ?>
                        <div class="col-12 col-md-6 form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio<?=$row['id']?>" name="customRadio" value="<?=$row['id']?>">
                                <label for="customRadio<?=$row['id']?>" class="custom-control-label"><?=$row['discipline_name']?></label>
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
    </section>
        
</div>


    <?php
include '../../includes/footer.php';
?>  
<script src="../../controller/students_controller/js/students_controller.js"></script>
