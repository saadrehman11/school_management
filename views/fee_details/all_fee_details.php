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
                <button class="btn btn-primary" id="search_submit_btn" onclick="load_students_data()"> Submit</button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="fee_table_div"></div>
</main>



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