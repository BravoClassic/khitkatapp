<?php

session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "db.inc.php";
    $logout_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
    if (isset($logout_id)) {
        $status = "Offline now";
        $sql = mysqli_query($conn, "UPDATE khaters SET status='{$status}' WHERE unique_id= {$logout_id}");
        if ($sql) {
            session_unset();
            session_destroy();
            echo "success";
        }
    }
} else {
    header("location:../login.php");
}
