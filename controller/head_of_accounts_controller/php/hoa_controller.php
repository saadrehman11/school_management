<?php
include '../../../includes/dbconnection.php';

$type = $_REQUEST['type'];

if($type=="101"){    
    // print_r($_POST);
    date_default_timezone_set('Asia/Karachi');
    $date_and_time = date("Y-m-d H:i:s");
    $stmt = $pconn->prepare("INSERT `head_of_accounts`(`account_name`, `category`, `amount`,`created_on`) VALUES  (:account_name, :category, :amount, :created_on)");
    $stmt->bindParam(':account_name', $account_name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':created_on', $date_and_time);

    // insert a row
    $account_name = $_POST['account_name'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    if($stmt->execute()){
        echo json_encode(['status_Code'=>100]);
    }

}