<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  
<style>
  .chosen-container{
  width: 100% !important;
}
</style>
<main id="main" class="main">
  <div class="d-flex justify-content-center"><h2>All Students</h2></div>

  <div class="container my-3">
        <div class="row">
            <div class="col-12 col-md-2 py-1">
                <input class="form-control" name="student_name" id="student_name" placeholder="Write Student Name" autocomplete="off" />
            </div>
            <div class="col-12 col-md-2 py-1">
                <input class="form-control" name="batch" id="batch" placeholder="Write batch" autocomplete="off" />
            </div>
            <div class="col-12 col-md-2 py-1">
                <select class="form-control" name="branch" id="branch">
                    <option value="" selected>Select</option>
                    <option value="nihms">NIHMS</option>
                    <option value="ncn">NCN</option>
                </select>
            </div>
            <div class="col-12 col-md-2 py-1">
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
            <div class="col-12 col-md-2 py-1">
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

  <div class="container pb-4">
    <div class="col-12 col-md-6">
      <div class="d-flex justify-content-around">
        <div>
          <input type="checkbox" class="check-all" id="all_students"/>
          <label class="mx-2" for="all_students">Select All Students</label>
        </div>
        <div>
          <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_hod_modal">Add Head of Account</button>
        </div>
        <div>
          <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#promote_modal">Promote</button>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6"></div>
    
  </div>
  
<div class="container-fluid">

<div class="table-responsive" id="students_table_div">

</div>


</div>
</main>

<!-- Edit Student Modal -->
<div class="modal fade" id="edit_student_modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
 
      <div class="modal-body">
      <div id="edit_student_div">

 
      </div>
      </div>
    </div>
  </div>
</div>


<!-- Promote Modal-->

<div class="modal fade" id="promote_modal" tabindex="-1" style="min-height:200px">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
 
      <div class="modal-body">
          <div class="container">
            <div class="row py-4">
              <h4>Add Head of Account to the Selected Students</h4>
            </div>
            <div class="row py-4">
              <div class="col-12 col-md-6">
                <select class=" chosen-select" id="hoaId" name="hoaId" multiple>
                  <option value="">Select Head Of Account</option>
                <?php
                  $ret_hoa=mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `status` = '1'"); 
                  while ($ret_hoa_row=mysqli_fetch_array($ret_hoa)) 
                  {
                    ?>
                    <option value="<?=$ret_hoa_row['id']?>"><?=$ret_hoa_row['account_name']?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <div class="col-12 col-md-6">
                <button onclick="promote_students()" class="btn btn-primary">Promote</button>
              </div>
              
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- ADD HOD Modal-->

<div class="modal fade" id="add_hod_modal" tabindex="-1" style="min-height:200px">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
 
      <div class="modal-body">
          <div class="container">
            <div class="row py-4">
              <h4>Add Head of Account to the Selected Students</h4>
            </div>
            <div class="row py-4">
              <div class="col-12 col-md-6">
                <select class="form-control" id="hoa_id" name="hoa_id">
                  <option value="">Select Head Of Account</option>
                <?php
                  $ret_hoa=mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `status` = '1'"); 
                  while ($ret_hoa_row=mysqli_fetch_array($ret_hoa)) 
                  {
                    ?>
                    <option value="<?=$ret_hoa_row['id']?>"><?=$ret_hoa_row['account_name']?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <div class="col-12 col-md-6">
                <button onclick="add_head_of_account()" class="btn btn-primary">Submit</button>
              </div>
              
            </div>
          </div>
      </div>
    </div>
  </div>
</div>


<?php
include '../../includes/footer.php';
?>  

<script src="../../controller/students_controller/js/students_controller.js"></script>

<script>
  load_students_data() 

  window.onload = (event) => {
    $("#hoaId").chosen({
      no_results_text: "Oops, nothing found!"
    })
};


  $(function() {
  // When the "Check All" checkbox is clicked
  $('.check-all').click(function() {
    // Get all the checkboxes in the table
    var checkboxes = $('#students_table').find(':checkbox');
    // Set their checked state to match the "Check All" checkbox
    checkboxes.prop('checked', $(this).prop('checked'));
  });

  // When any other checkbox is clicked
  $(document).on('click', '#students_table :checkbox:not(.check-all)', function() {
    // If all the other checkboxes are checked, check the "Check All" checkbox
    if ($('#students_table :checkbox:not(.check-all)').length === $('#students_table :checkbox:not(.check-all):checked').length) {
      $('.check-all').prop('checked', true);
    } else {
      $('.check-all').prop('checked', false);
    }
  });

  // Check the status of the checkboxes at page load
  if ($('#students_table :checkbox:not(.check-all):checked').length === 0) {
    $('.check-all').prop('checked', false);
  }
});







</script>