<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  

<div class="container">
    <div class="row py-3">
        <a class="btn btn-primary" href="add_student.php">Add New Student</a>
    </div>
    <div class="row">

    <div class="table-responsive">
  <table class="table">
  <caption>List of users</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
</div>


    </div>

</div>
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/students_controller/js/students_controller.js"></script>
