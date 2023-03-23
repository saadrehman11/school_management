<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  
<main id="main" class="main">

    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-md-6 py-1">
                <input class="form-control" name="student_name" id="student_name" placeholder="Write Student Name" autocomplete="off" />
            </div>
            <div class="col-12 col-md-4 py-1">
                <input class="form-control" name="batch" id="batch" placeholder="Write batch" autocomplete="off" />
            </div>
            <div class="col-12 col-md-3 py-1">
                <select class="form-control" name="branch" id="branch">
                    <option value="" selected>Select</option>
                    <option value="nihms">NIHMS</option>
                    <option value="ncn">NCN</option>
                </select>
            </div>
            <div class="col-12 col-md-3 py-1">
                <select class="form-control" name="semester" id="semester">
                    <option value="" selected>Semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            <div class="col-12 col-md-3 py-1">
                <select class="form-control" name="discipline" id="discipline">
                <option value="" selected>Discipline</option>
                    <?php 
                    $ret=mysqli_query($con,"SELECT * FROM `discipline` WHERE `status` = '1'"); 
                    while ($row=mysqli_fetch_array($ret)) 
                    {
                        ?>
                        <option value="<?=$row['id']?>"><?=$row['discipline_name']. "(".$row['program'].")"?></option>
                        <?php
                    }
                    ?>
                    
                </select>
            </div>
            <div class="col-12 col-md-2 py-1">
                <button class="btn btn-primary" id="search_submit_btn" onclick="load_students_data()"> Search</button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="fee_table_div"></div>
</main>
<div class="modal fade" id="submit_fee_modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
 
      <div class="modal-body" id="fee_submit_modal_body"></div>
    </div>
  </div>
</div>


<!-- Edit Student Modal-->
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/fee_details_controller/js/fee_details_controller.js"></script>
<script>
    $(function() {
        load_students_data();
    });
</script>