<?php
session_start();
include_once 'db.inc.php';
$sender_id =$_SESSION['unique_id'];
$sql_query = mysqli_query($conn, "SELECT * FROM khaters WHERE NOT unique_id={$sender_id} ORDER BY fname");
$output;
if (mysqli_num_rows($sql_query) == 1) {
    // $row = mysqli_fetch_assoc($sql_query);
    $output .= "No users are on the platform";
} elseif (mysqli_num_rows($sql_query) > 0) {
    include 'list.inc.php';
}
echo $output;
