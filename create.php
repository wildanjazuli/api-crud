<?php
require 'database.php';

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);
    if (trim($request->username) === '' || trim($request->fullname) === '' || trim($request->password) === '') {
        return http_response_code(400);
    }

    $username = mysqli_real_escape_string($con, trim($request->username));
    $fullname = mysqli_real_escape_string($con, trim($request->fullname));
    $password = mysqli_real_escape_string($con, trim($request->password));

    $sql = "INSERT INTO `user`(`id`,`username`,`fullname`,`password`) VALUES (null,'{$username}','{$fullname}','{$password}')";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);
        $user = [
            'username' => $username,
            'fullname' => $fullname,
            'password' => $password,
            'id'    => mysqli_insert_id($con)
        ];
        echo json_encode($user);
    } else {
        http_response_code(422);
    }
}
