<?php

$host="localhost";
$user="root";
$password="";
$db="school_management";

$con=mysqli_connect($host,$user, $password, $db);
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}
else{
    // echo "successful connection";
}


// pdo connection
try {
    $pconn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    // set the PDO error mode to exception
    $pconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pconn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  //   echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  



?>