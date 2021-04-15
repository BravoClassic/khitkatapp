<?php

session_start();
include_once "db.inc.php";
include "functions.inc.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$img = mysqli_real_escape_string($conn, $_POST['profile']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailThere = emailExists($conn, $email);
        if (!$emailThere) {

            if (isset($_FILES["profile"])) {
                $profile_image_name = $_FILES["profile"]["name"];
                $profile_image_type = $_FILES["profile"]["type"];
                $profile_tmp_name = $_FILES["profile"]["tmp_name"];
                //Get the extension of the image 
                $img_explode = explode(".", $profile_image_name);
                $img_ext = end($img_explode); //Extension of image here
                $extensions = ['png', 'jpg', 'jpeg'];
                if (in_array($img_ext, $extensions)) {
                    $time = time();
                    $new_image_name = $time.$profile_image_name;
                    if (move_uploaded_file($profile_tmp_name, "../images/users/" . $new_image_name)) {
                        $status = "Active now";
                        $random_id = rand(time(), 10000000);

                        createUser($conn,$random_id,$fname,$lname,$email,$password,$new_image_name,$status);
                      
                    }else{
                        echo 'Could not upload the file';
                    }
                } else {
                    echo "Please upload an image with extensions png, jpg or jpeg";
                }
            } else {
                echo "Please upload an image";
            }
        } else {
            echo 'Email exists already - '.$email;
        }
    } else {
        echo "$email - Invalid email!";
    }
} else {
    echo "All field are required";
}
