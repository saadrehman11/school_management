<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  
<main id="main" class="main">
  <div class="container-fluid">

    <div class="d-flex justify-content-end pb-4">
      <div class="row ">
        <label for="inputDate" class="col-sm-2 col-form-label">Date:</label>
        <div class="col-sm-10">
          <input type="date" id="myDateInput" class="form-control" onchange="load_statistics()">
        </div>
      </div>
    </div>
    <div class="row table-responsive" id="main_stats_table">
    
    </div>
  </div>
</main>

<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/statistics_controller/js/statistics_controller.js"></script>

<script>
  window.addEventListener("load", (event) => {
    var today = new Date().toISOString().substr(0, 10);
    document.getElementById("myDateInput").value = today;
    load_statistics()
    console.log("page is fully loaded");
  });
</script>

