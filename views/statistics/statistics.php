<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  
<main id="main" class="main">
<div class="container-fluid">

<div class="table-responsive">
  <table class="table table-striped datatable " id="hoa_stats_table">
  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Current Date</th>
      <th scope="col">Amount Collected Today</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $ret=mysqli_query($con,"SELECT * FROM `head_of_accounts` where status = '1' ORDER BY id ASC "); 
    $count = 1;
    while ($row=mysqli_fetch_array($ret)) 
    {
      $hoa_id = $row['id'];
      ?>
      <tr>
        <td><?=$count?></td>
        <td>
          <p class="text-sm mb-0"><?=$row['account_name']?></p>
        </td>
        <td>
          <p class="text-sm mb-0"><?=$row['category']?></p>  
        </td>
        <td>
          <p class="text-sm"><?=$row['amount']?></p></td>
        <td>
          
        </td>
      
      </tr>
      <?php
      $count++;
    }
    ?>
  </tbody>
</table>
</div>
</div>
</main>

<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/head_of_accounts_controller/js/hoa_controller.js"></script>
