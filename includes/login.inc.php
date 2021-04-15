<?php

session_start();
include_once "db.inc.php";
include "functions.inc.php";
$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$status = "Active now";

if(!empty($email) && !empty($password) ){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $emailThere=emailExists($conn,$email);
        if($emailThere){
            loginUser($conn,$email,$password,$status);
        } else {
            echo "Email does not exist! Register to access application.";
        }
    }else {
        echo "$email - Invalid email!";
    }
}else{
    echo "All field are required";
}

?>