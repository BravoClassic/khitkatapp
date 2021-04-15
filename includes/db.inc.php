<?php

    $serverName ="localhost";
    $user="root";
    $password="brav123";
    $dbName="khitkhat-app";
    
    $conn = mysqli_connect($serverName,$user,$password,$dbName);
    
    if(!$conn){
        die("Connection failed:". mysqli_connect_error());
    }