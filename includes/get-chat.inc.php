<?php
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "db.inc.php";
    $sender_id=mysqli_real_escape_string($conn,$_POST['outgoing_id']);
    $receiver_id=mysqli_real_escape_string($conn,$_POST['incoming_id']);
   $output="";

   $sql = "SELECT * FROM message_khater LEFT JOIN khaters ON khaters.unique_id=message_khater.sender_id WHERE (sender_id={$sender_id} AND receiver_id={$receiver_id}) OR (sender_id={$receiver_id} AND receiver_id={$sender_id}) ORDER BY message_id ASC";
   $query = mysqli_query($conn,$sql);
   if(mysqli_num_rows($query)>0){
       while($row=mysqli_fetch_array($query)){
           if($row['sender_id']===$sender_id){
               $output .='<div class="chat outgoing">
               <div class="details">
                 <p>'.$row['text'].'</p>
               </div>
             </div>';
           }else{
               $output .= '<div class="chat incoming">
               <img src="images/users/'.$row['profile'].'" alt="">
               <div class="details">
                 <p>'.$row['text'].'</p>
               </div>
             </div>';
           }
       }
       echo $output;
   }
}else{
    header('Location:../login.php');
}