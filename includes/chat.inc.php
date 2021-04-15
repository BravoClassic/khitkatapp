<?php
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "db.inc.php";
    $unique_id = $_SESSION['unique_id'];
    $outgoing_id=mysqli_real_escape_string($conn,$_POST['outgoing_id']);
    $incoming_id=mysqli_real_escape_string($conn,$_POST['incoming_id']);
    $message=mysqli_real_escape_string($conn,$_POST['messageSender']);
    if(!empty($message)){
        $sql = mysqli_query($conn,"INSERT INTO message_khater (sender_id, receiver_id, text) VALUES('{$outgoing_id}','{$incoming_id}','{$message}')");
        $sql2=mysqli_query($conn, "SELECT fname FROM khaters WHERE unique_id = {$outgoing_id}");
        if(mysqli_num_rows($sql2)>0){
            $row=mysqli_fetch_assoc($sql2);
            mysqli_close($sql);
            mysqli_close($sql2);
            $name=$row['fname'];
            $data = "$outgoing_id,$incoming_id,$message,$unique_id,$name";//0:sender, 1:receiver, 2:message, 3:unique_id, 4:name
        }
        echo $data;
    }
}else{
    header('Location:../login.php');
}