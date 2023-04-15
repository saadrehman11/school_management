<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  
<main id="main" class="main">
<div class="container-fluid">

<div class="table-responsive">
  <table class="table table-striped datatable " id="hoa_table">
  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Amount</th>
      <th scope="col">Action</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $ret=mysqli_query($con,"SELECT * FROM `head_of_accounts` "); 
    $count = 1;
    while ($row=mysqli_fetch_array($ret)) 
    {
      $hoa_id = $row['id'];
      
      ?>
      <tr>
        <td><?=$count?></td>
        <td>
          <p class="text-sm mb-0"><?=$row['account_name']?></p></td>
        <td>
          <p class="text-sm mb-0"><?=$row['category']?></p>  
        </td>
        <td>
          <p class="text-sm"><?=$row['amount']?></p></td>
        <td>
          <div>
            <button class="btn btn-sm btn-warning" onclick="load_hoa_detail(<?=$hoa_id?>)" data-bs-toggle="modal" data-bs-target="#edit_hoa_modal"><i class="bi bi-pencil-square"></i></button>
            <?php
            if($row['status'] == '1'){
              ?>
              <button class="btn btn-sm btn-danger" onclick="change_status_hoa(<?=$hoa_id?>,2)">InActive</button>
              <?php
            }
            else{
              ?>
              <button class="btn btn-sm btn-primary" onclick="change_status_hoa(<?=$hoa_id?>,1)">Active</button>
              <?php
            }
            ?>
          </div>
        </td>
        <td>
          <?php
          if($row['status'] == '1'){
            ?>
              <p class="text-white bg-success text-sm p-1 text-center mb-0">Active</p>
            <?php
          }elseif($row['status'] == '2'){
            ?>
              <p class="text-white bg-danger text-sm p-1 text-center mb-0">InActive</p>
            <?php
          }
        ?>
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

<!-- Edit hoa Modal -->
<div class="modal fade" id="edit_hoa_modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-body" id="hoa_edit">
      
      </div>
    </div>
  </div>
</div>

<!-- Edit Student Modal-->
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/head_of_accounts_controller/js/hoa_controller.js"></script>

<script>
  $('#hoa_table').dataTable( { } );
</script>
