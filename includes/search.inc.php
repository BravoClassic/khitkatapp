<?php
session_start();
include_once 'db.inc.php';
$output="";
$sender_id =$_SESSION['unique_id'];
$searchKeyWord =mysqli_real_escape_string($conn,$_POST['searchKeyWord']);
$sql_query = mysqli_query($conn,"SELECT * FROM khaters WHERE NOT unique_id={$sender_id} AND (fname LIKE '%{$searchKeyWord}%' OR lname LIKE '%{$searchKeyWord}%')");
if(mysqli_num_rows($sql_query)>0){
    include "list.inc.php";
}else{
    $output .= "No users found";
}
echo $output;
?>