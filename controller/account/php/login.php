<?php
// Turn off all error reporting
error_reporting(0);
include '../../../includes/dbconnection.php';
$type= $_REQUEST['type'];

if($type=='100'){
    $url = "http://" . $_SERVER['SERVER_NAME']."/projects/admin_panels/inventory_management//views/" ; 
  
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password using PHP's password_hash function
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query the database to check if the email and password combination is correct
    // Replace "users" with your actual table name
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
        // If the password is correct, create a session and redirect the user to the dashboard
        session_start();
        $_SESSION['email'] = $email;
        
        // header('Location: dashboard/dashboard.php' );
        echo json_encode(['status_Code'=>100]);
    } else {
        // If the password is incorrect, display an error message
        echo json_encode(['status_Code'=>400,'msg'=>"Invalid email or password."]);
    }

}
?>