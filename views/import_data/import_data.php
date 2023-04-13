<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  

<main id="main" class="main">
<div class="container py-2">

<div class="container">
    <h1 class="mt-3">Excel Importer</h1>
    <form id="import_file_form" method="post" action="#" onsubmit="import_data();return false" class="mt-3">
    <div class="mb-3">
        <label for="excel-file" class="form-label">Select Excel file to upload:</label>
        <input type="file" id="excel-file" name="excel-file" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Import</button>
    </form>
</div>
</div>
</main>
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/students_controller/js/students_controller.js"></script>
