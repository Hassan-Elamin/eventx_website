<?php

include '../../../data_access/database/php/connect_database.php';
include '../../../business_logic/data_handlers/user_handler.php';
include '../../../business_logic/image_uploader.php';

$userH = new UserHandler($database);

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $birthdate = $_POST['birthdate'];
    $password = $_POST['password'];

    print_r($_FILES['profile-img']);

    $sql = "SELECT uid FROM users WHERE email = '$email'";
    $response = $database->query($sql);
    if ($response->num_rows !== 0) {
        echo "this email is already exists";
        exit();
    } else {
        $profile_img = '';
        if (!empty($_FILES['profile-img']['name'])) {
            $dest = $_SERVER['DOCUMENT_ROOT'] . '/uploads/eventx/images/profile_imgs/';
            $upload = $profile_img = uploadImageToServer($_FILES['profile-img'], $dest, $username . 'pfimage');
            if (!is_string($upload)) {
                exit('img did not upload');
            } else {
                $profile_img = $upload;
            }
        }
        $res = $userH->addUser($username, $email, $password, $birthdate, $profile_img);
        if ($res) {
            sleep(3);
            header("location:../signin/signin.php");
            exit();
        } else {
            exit("error");
        }
    }
}