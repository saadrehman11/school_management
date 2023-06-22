<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  
<main id="main" class="main pt-0">
  <div class="container-fluid">
  <div class="d-flex justify-content-center">
      <h3>Head Of Accounts Stats</h3>
    </div>
    <div class="d-flex justify-content-end pb-1">
      <div class="row">
        <label for="inputDate" class="col-sm-2 col-form-label">Date:</label>
        <div class="col-sm-10">
          <input type="date" id="myDateInput" class="form-control" onchange="load_statistics()">
        </div>
      </div>
    </div>
    <div class="row table-responsive" id="main_stats_table"></div>
  </div>

  <div class="row">
    <div class="col-12 col-md-6">
      <div class="container-fluid pt-5">
        <div class="d-flex justify-content-center">
          <h3>Batch Wise Stats</h3>
        </div>
        <div id="batch_wise_stats_div"></div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="container-fluid pt-5">
      <div class="d-flex justify-content-center">
        <h3>Discipline Wise Stats</h3>
      </div>
      <div id="discipline_wise_stats_div"></div>
    </div>
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
    batch_wise_stats() 
    discipline_wise_stats() 
  });
</script>

