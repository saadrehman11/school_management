<?php
include '../../../includes/dbconnection.php';

$type = $_REQUEST['type'];

// Head of accounts stats
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
                <p class="text-sm mb-0">Rs. <?=$check_stats_with_date['amount_paid']?></p>
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



// discipline wise stats 
if($type=="102"){
    $ret2=mysqli_query($con,"SELECT
    *,SUM(fee_record.total_amount) as total_amount, SUM(fee_record.amount_paid) as amount_paid
FROM
    `student`
INNER JOIN discipline ON student.discipline = discipline.id
LEFT JOIN fee_record ON student.id = fee_record.student_id
GROUP BY
    student.batch,
    student.discipline
ORDER BY
    discipline.id;"); 
    $count = 1;
    ?>
    <table class="table table-striped datatable " id="discipline_stats_table">
        <thead class="bg-dark text-white">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Discipline Name</th>
            <th scope="col">Batch</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Amount Collected</th>
            <th scope="col">Outstanding</th>
            <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
    <?php
    while ($row2=mysqli_fetch_array($ret2)) 
    {
        $batch = $row2['batch'];
        $discipline_id = $row2['discipline'];

        $check_discipline = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `discipline` WHERE `id` = '$discipline_id'"));
        
        $check_stats_all = mysqli_fetch_array(mysqli_query($con,"SELECT
        *,
        SUM(fee_record.total_amount) AS total_amount,
        SUM(fee_record.amount_paid) AS amount_paid
    FROM
        `student`
    LEFT JOIN fee_record ON student.id = fee_record.student_id
    WHERE
        discipline = '$discipline_id' AND student.batch = '$batch'"));

        $total_amount = $check_stats_all['total_amount'];
        $amount_paid = $check_stats_all['amount_paid'];
        $Outstanding = $total_amount-$amount_paid;
        ?>
        <tr>
            <td><?=$count?></td>
            <td>
                <p class="text-sm mb-0"><?=$check_discipline['discipline_name'].' ('.$row2['program'].') '?></p>
            </td>
            <td>
                <p class="text-sm mb-0"><?=$batch?></p>
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$total_amount?></p>
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$amount_paid?></p>  
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$Outstanding?></p>  
            </td>
            <td>
            <a class="btn btn-info btn-sm" data-bs-target="#semester_row<?=$discipline_id.$batch?>" data-bs-toggle="collapse" href="#" onclick="show_semester_detail('<?=$discipline_id?>','<?=$batch?>')"><i class="bi bi-clipboard-check"></i> Details</a>
               
            </td>
        </tr>
        <tr>
        <td colspan="7">
          <div class="collapse" id="semester_row<?=$discipline_id.$batch?>"></div>
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

// semester wise stats
if($type=="103"){

    $total_amount = 0;
    $paid_amount = 0;
    $outstanding_amount = 0;
    $batch = $_POST['batch'];
    $discipline_id = $_POST['discipline_id'];

    $ret=mysqli_query($con,"SELECT
    *,
    SUM(`total_amount`) AS total_amount_all,
    SUM(`amount_paid`) AS amount_paid_all
    FROM
        `student`
    LEFT JOIN fee_record ON student.id = fee_record.student_id
    WHERE
        `discipline` = '$discipline_id' AND `batch` = '$batch'
    GROUP BY
        fee_record.semester
    ORDER BY
        semester"); 
    $counter =0;
    ?>
    <table class="table table-striped datatable " id="discipline_stats_table">
        <thead class="bg-primary text-white">
            <tr>
            <th scope="col">Semester</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Amount Collected</th>
            <th scope="col">Outstanding</th>
            </tr>
        </thead>
        <tbody>
    <?php
    while ($row=mysqli_fetch_array($ret)) 
    {
        $student_id = $row['id'];
        $discipline_id = $row['discipline'];
        
        $check_discipline = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `discipline` WHERE `id` = '$discipline_id'"));
?>
        <tr>
           
            <td>
                <p class="text-sm mb-0"><?=$row['semester']?></p>
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$row['total_amount_all']?></p>
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$row['amount_paid_all']?></p>  
            </td>
            <td>
                <?php 
                $Outstanding = intval($row['total_amount_all']) - intval($row['amount_paid_all']);
                ?>
                <p class="text-sm mb-0">Rs. <?=$Outstanding?></p>  
            </td>
        </tr>
    <?php
        $counter++;
    }
    ?>
        </tbody>
    </table>
    <?php
}


// batch wise stats
if($type=="104"){

    $total_amount2 = 0;
    $paid_amount2 = 0;
    $outstanding_amount2 = 0;

    $ret=mysqli_query($con,"SELECT
    *,
    SUM(`total_amount`) AS total_amount_all,
    SUM(`amount_paid`) AS amount_paid_all
    FROM
        `student`
    INNER JOIN fee_record ON student.id = fee_record.student_id
    GROUP BY
        student.batch
    ORDER BY
        student.batch DESC"); 
    $counting =1;
    ?>
    <table class="table table-striped datatable " id="discipline_stats_table">
        <thead class="bg-dark text-white">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Batch</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Amount Collected</th>
            <th scope="col">Outstanding</th>
            <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
    <?php
    while ($row=mysqli_fetch_array($ret)) 
    {
        $student_id = $row['id'];
        $batch = $row['batch'];
?>
        <tr>
           
            <td>
                <p class="text-sm mb-0"><?=$counting?></p>
            </td>
            <td>
                <p class="text-sm mb-0"><?=$row['batch']?></p>
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$row['total_amount_all']?></p>
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$row['amount_paid_all']?></p>  
            </td>
            <td>
                <?php 
                $Outstanding = intval($row['total_amount_all']) - intval($row['amount_paid_all']);
                ?>
                <p class="text-sm mb-0">Rs. <?=$Outstanding?></p>  
            </td>
            <td>
            <a class="btn btn-info btn-sm" data-bs-target="#semester_wise_row<?=$batch?>" data-bs-toggle="collapse" href="#" onclick="show_semester_wise_detail('<?=$batch?>')"><i class="bi bi-clipboard-check"></i> Details</a>
            </td>
        </tr>
        <td colspan="7">
          <div class="collapse" id="semester_wise_row<?=$batch?>"></div>
        </td>
    <?php
        $counting++;
    }
    ?>
        </tbody>
    </table>
    <?php
}

if($type=="105"){

    $batch = $_POST['batch'];
    $ret=mysqli_query($con,"SELECT
    *,
    SUM(`total_amount`) AS total_amount_all,
    SUM(`amount_paid`) AS amount_paid_all
    FROM
        `student`
    INNER JOIN fee_record ON student.id = fee_record.student_id
    WHERE batch = '$batch' 
    GROUP BY
        student.batch,
        fee_record.semester
    ORDER BY
        student.batch DESC"); 

    ?>
    <table class="table table-striped datatable " id="batch_stats_table">
        <thead class="bg-primary text-white">
            <tr>
            <th scope="col">Semester</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Amount Collected</th>
            <th scope="col">Outstanding</th>
            </tr>
        </thead>
        <tbody>
    <?php
    while ($row=mysqli_fetch_array($ret)) 
    {
        $student_id = $row['id'];
    ?>
        <tr>
           
            <td>
                <p class="text-sm mb-0"><?=$row['semester']?></p>
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$row['total_amount_all']?></p>
            </td>
            <td>
                <p class="text-sm mb-0">Rs. <?=$row['amount_paid_all']?></p>  
            </td>
            <td>
                <?php 
                $Outstanding = intval($row['total_amount_all']) - intval($row['amount_paid_all']);
                ?>
                <p class="text-sm mb-0">Rs. <?=$Outstanding?></p>  
            </td>
        </tr>
    <?php
    }
    ?>
        </tbody>
    </table>
    <?php
}