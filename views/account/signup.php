
<?php
    include '../../includes/header.php';
    // include '../../includes/sidebar.php';
?>
<div class="dashboard-wrapper">
<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-primary text-light">
          <h4 class="card-title text-light">Create New Account</h4>
        </div>
        <div class="card-body">
        <form id="signup_form"  method="post" action="#" onsubmit="signup();return false">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
          </form>
        </div>
        <div id="msg">
        </div>
      </div>
    </div>
  </div>
</div>



<?php
    include '../../includes/footer.php';
?>
<script src="../../controller/account/js/signup.js"></script>