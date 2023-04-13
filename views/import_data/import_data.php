<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';

?>  

<main id="main" class="main">
<div class="container py-2">

<div class="container">
    <h1 class="mt-3">Excel Importer</h1>
    <form id="import_file_form" method="post" action="#" class="mt-3">
    <div class="mb-3">
        <label for="excel-file" class="form-label">Select Excel file to upload:</label>
        <input type="file" id="excel-file" name="excel-file" class="form-control">
    </div>
    <button type="button" onclick="import_data()" class="btn btn-primary" id="import_btn">Import</button>
    </form>
</div>
</div>
</main>
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/import_data_controller/js/import_data_controller.js"></script>
