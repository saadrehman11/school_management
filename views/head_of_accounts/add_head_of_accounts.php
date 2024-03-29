<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  

<main id="main" class="main">
  <div class="d-flex justify-content-center"><h2>Add Head Of Account</h2></div>
<div class="container py-2">

    <form id="new_hoa_form"  method="post" action="#" onsubmit="new_hoa_form();return false">
      <div class="d-flex justify-content-center mt-3">
        <div class="col-md-6">
          <div class="card card-primary py-4">
            <div class="card-body">
              <div class="form-group py-2">
                <label for="account_name">Account Name</label>
                <input type="text" id="account_name"  name="account_name" class="form-control" required>
              </div>
              <div class="form-group py-2">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control custom-select" >
                  <option selected disabled>Select Category</option>
                  <option value="General">General</option>
                  <option value="BS Degree">BS Degree</option>
                  <option value="Diploma">Diploma</option>
                  <option value="CAT-B">CAT-B</option>
                  <option value="Nursing">Nursing</option>
                  
                  </select>
              </div>
              <div class="form-group py-2">
                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" class="form-control">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
      <div>
        <div class="d-flex justify-content-evenly">
         
          <input type="submit" class="btn btn-success float-right">
        </div>
      </div>
      </form>
</div>
</main>
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/head_of_accounts_controller/js/hoa_controller.js"></script>
