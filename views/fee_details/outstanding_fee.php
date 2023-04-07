<?php
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>  

<main id="main" class="main">
<div class="container py-2">

        
</div>
</main>
<?php
include '../../includes/footer.php';
?>  
<script src="../../controller/fee_details_controller/js/fee_details_controller.js"></script>
<?php
// SELECT `student_id`, semester, SUM(total_amount) AS total_amount, SUM(amount_paid) AS amount_paid_per_semester
// FROM fee_record
// GROUP BY student_id, semester
// HAVING SUM(amount_paid) < SUM(total_amount)

?>