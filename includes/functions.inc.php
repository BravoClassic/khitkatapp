<?php

function emailExists($conn, $email): bool
{
    $sql = "SELECT * FROM khaters WHERE email= '{$email}'";
    $sqlQuery = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sqlQuery) > 0) {
        // echo "$email - Exists already";
        return true;
    } else {
        return false;
    }
}

function createUser($conn, $random_id, $fname, $lname, $email, $password, $profile, $status)
{
    $hashed = md5($password);
    $sql = mysqli_query($conn, "INSERT INTO khaters (unique_id, fname, lname, email, password ,profile, status) 
VALUES ('{$random_id}','{$fname}','{$lname}','{$email}','{$hashed}','{$profile}','{$status}')");

    if ($sql) {
        $sql_query = mysqli_query($conn, "SELECT * FROM khaters WHERE email ='{$email}'");
        if (mysqli_num_rows($sql_query) > 0) {
            $row = mysqli_fetch_assoc($sql_query);
            $_SESSION['unique_id'] = $row['unique_id'];
            echo "success";
        }
    } else {
        echo "Unfortunately, something went wrong!";
    }
}


function loginUser($conn, $email, $password, $status)
{
    $hashed = md5($password);
    $sql_query = mysqli_query($conn, "SELECT * FROM khaters WHERE email ='{$email}'");
    if (mysqli_num_rows($sql_query) > 0) {
        $row = mysqli_fetch_assoc($sql_query);
        if ($row['password'] == $hashed) {
            $_SESSION['unique_id'] = $row['unique_id'];
            if (isset($_SESSION['unique_id'])) {
                $sql = mysqli_query($conn, "UPDATE khaters SET status='{$status}' WHERE unique_id=  {$_SESSION['unique_id']}");
                if ($sql)
                    echo "success";
            }
        } else {
            echo "This is an invalid password.";
        }
    } else {
        echo "Unfortunately, something went wrong!";
    }
}

function passwordHashed($password)
{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $hash;
}
