<?php

while ($row = mysqli_fetch_assoc($sql_query)) {
    $unique_id = $row['unique_id'];
    $sql_query_two = "SELECT * FROM message_khater WHERE (receiver_id={$unique_id} OR sender_id={$unique_id}) AND (receiver_id={$sender_id} OR sender_id={$sender_id}) ORDER BY message_id DESC LIMIT 1";
    $query_two = mysqli_query($conn, $sql_query_two);
    $row2 = mysqli_fetch_assoc($query_two);
    if (!mysqli_num_rows($row2)) { //something is not right here.... Need to check it later
        $result = $row2['text'];
    } else {
        $result = "No messages avaliable...";
    }

    (strlen($result) > 28) ? $message = substr($result, 0, 28) : $message = $result;
    ($sender_id == $row2['sender_id']) ? $you = "You:" : $you = "";
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline="";
    $output .= '
<a href="chat.php?user_id=' . $row['unique_id'] . '">
    <div class="content">
        <img src="images/users/' . $row['profile'] . '" alt="">
        <div class="details">
        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
        <p>' . $you . " " . $message . '</p>
        </div>
    </div>
    <div class="status-dot'." ".$offline.'"><i class="fas fa-circle"></i></div>
</a>';
}
