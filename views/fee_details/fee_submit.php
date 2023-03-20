<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  

<main id="main" class="main">
    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-md-5 py-1">
                <input class="form-control" name="student_name" id="student_name" placeholder="Write Student Name" autocomplete="off" />
            </div>
            <div class="col-12 col-md-5 py-1">
                <select class="form-control" name="branch" id="branch">
                    <option value="" selected>Select</option>
                    <option value="nihms">NIHMS</option>
                    <option value="ncn">NCN</option>
                </select>
            </div>
            <div class="col-12 col-md-2 py-1">
                <button class="btn btn-primary" id="search_submit_btn" onclick="load_students_data('1')"> Submit</button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="fee_table_div"></div>
    
</main>
<div class="modal fade" id="submit_fee_modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
 
      <div class="modal-body" id="fee_submit_modal_body">
        
      </div>
    </div>
  </div>
</div>
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/fee_details_controller/js/fee_details_controller.js"></script>
