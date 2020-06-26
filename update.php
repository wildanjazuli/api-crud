<?php
require 'database.php';

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if ((int) $request->id < 1 || trim($request->username) == '' || trim($request->fullname) == '' || trim($request->password) == '') {
        return http_response_code(400);
    }

    $id    = mysqli_real_escape_string($con, (int) $request->id);
    $username = mysqli_real_escape_string($con, trim($request->username));
    $fullname = mysqli_real_escape_string($con, trim($request->fullname));
    $password = mysqli_real_escape_string($con, trim($request->password));

    $sql = "UPDATE `user` SET `username`='$username',`fullname`='$fullname',`password`='$password' WHERE `id` = '{$id}' LIMIT 1";

    if (mysqli_query($con, $sql)) {
        http_response_code(204);
    } else {
        return http_response_code(422);
    }
}