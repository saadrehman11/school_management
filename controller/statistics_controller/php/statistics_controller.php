<?php
include '../../../includes/dbconnection.php';

$type = $_REQUEST['type'];

if($type=="101"){

    $dateValue = $_POST['dateValue'];
    $ret=mysqli_query($con,"SELECT * FROM `head_of_accounts` WHERE `status` = '1'"); 
    $count = 1;
    ?>
    <table class="table table-striped datatable " id="hoa_stats_table">
        <thead class="bg-dark text-white">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Total Amount Collected</th>
            <th scope="col">Amount Collected on <?=$dateValue?></th>
            </tr>
        </thead>
        <tbody>
    <?php
    while ($row=mysqli_fetch_array($ret)) 
    {
        $hoa_id = $row['id'];
        $check_stats_all = mysqli_fetch_array(mysqli_query($con,"SELECT *, SUM(`amount_paid`) as amount_paid_all FROM `fee_record` WHERE `hoa_id` = '$hoa_id'"));
        $check_stats_with_date = mysqli_fetch_array(mysqli_query($con,"SELECT *, SUM(`amount_paid`) as amount_paid FROM `fee_record` WHERE `hoa_id` = '$hoa_id' AND DATE(`created_on`) ='$dateValue'"));
        ?>
        <tr>
            <td><?=$count?></td>
            <td>
                <p class="text-sm mb-0"><?=$row['account_name']?></p>
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$check_stats_all['amount_paid_all']?></p>  
            </td>
            <td>
                <p class="text-sm">Rs. <?=$check_stats_with_date['amount_paid']?></p>
            </td>
        </tr>
        <?php
        $count++;
    }

    ?>
        </tbody>
    </table>
    <?php
}