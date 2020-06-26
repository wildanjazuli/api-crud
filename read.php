<?php

require 'database.php';

$users = [];
$sql = "SELECT id, username, fullname, password FROM user";

if ($result = mysqli_query($con, $sql)) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $users[$i]['id']    = $row['id'];
        $users[$i]['username'] = $row['username'];
        $users[$i]['fullname'] = $row['fullname'];
        $users[$i]['password'] = $row['password'];
        $i++;
    }

    echo json_encode($users);
} else {
    http_response_code(404);
}