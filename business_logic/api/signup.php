<?php 

print_r($_POST);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $img = $_FILES[''];

    $sql = "SELECT `uid` FROM users WHERE email = '$email' ";

    $response = $database->query($sql);

    if ($response->num_rows > 0) {
        return "this email is already exists";
    } else {
        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `profile_img`) VALUES ('$username','$email','$password','$profile_img')";
        $response = $database->query($sql);
        if ($response) {
            return true;
        }
        return false;
    }

}