<?php

// $server ="localhost";
// $username="root";
// $password="brav123";
// $db="khitkhat-app";


// $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// $server = $url["host"];
// $username = $url["user"];
// $password = $url["pass"];
// $db = substr($url["path"], 1);


$server = "freedb.tech";
$username = "freedbtech_yotechater";
$password = "2tCRxQbCJw47PR9";
$db = "freedbtech_yoteschat";

$conn = mysqli_connect($server, $username, $password, $db);

if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
}
