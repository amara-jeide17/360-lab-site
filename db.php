<?php //basically following tutorial
    $host = "byhmfdyzcaglrr9dwgdw-mysql.services.clever-cloud.com";
    $user = "udagl77vtfqd1bua";
    $password = "BOTzKJl0AuQriskKdELB";
    $database = "byhmfdyzcaglrr9dwgdw";
    $con = mysqli_connect($host,$user,$password,$database); 
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();//error handling
    }
?>