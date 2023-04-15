<?php
include '../../../includes/dbconnection.php';
$type= $_REQUEST['type'];

if($type=='100'){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password using PHP's password_hash function
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query the database to check if the email is already registered
    // Replace "users" with your actual table name
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // If the email is already registered, display an error message
        echo json_encode(['status_Code'=>400,'msg'=>"Email is already registered."]);
    } else {
        // If the email is not registered, insert the new user into the database
        $query = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
        mysqli_query($con, $query);
        echo json_encode(['status_Code'=>100,'msg'=>"New account created successfully."]);
    }
}
?>