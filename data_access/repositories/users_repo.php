<?php

class UsersRepository
{

    protected $database;

    public function __construct(mysqli $database)
    {
        $this->database = $database;
    }

    function getUser($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = '$email' AND `password` = '$password'";
        $response = $this->database->query($sql);
        if ($response->num_rows === 1) {
            return $response->fetch_assoc();
        } else {
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $res = $this->database->query($sql);
            if($res->num_rows > 0){
                return "password is not correct";
            }
            return "user not found";
        }
    }

    function getUserById(int $uid)
    {
        $sql = "SELECT * FROM `users` WHERE uid = $uid;";
        $response = $this->database->query($sql);
        return $response->fetch_assoc();
    }

    function checkUserExists($uid): bool
    {
        $sql = "SELECT * FROM `users` WHERE uid = $uid;";
        $response = $this->database->query($sql);
        if ($response->num_rows > 0) {
            return true;
        }
        return false;
    }

    function addUser($username, $email, $password, $birthdate, $profile_img): bool
    {
        $sql = "INSERT INTO `users`(`username`, `email`, `password`,`birthdate` ,`profile_img`) VALUES ('$username','$email','$password', '$birthdate', '$profile_img')";
        $response = $this->database->query($sql);
        if ($response) {
            return true;
        } else {
            return false;
        }
    }

    function updateUser($uid, $username, $email, $birthdate, $profile_img): bool {
        
        return false ;
    }

    function updateUserImage ($profile_img){
        $sql = "UPDATE `users` SET `profile_img` = '$profile_img' WHERE uid = {$_COOKIE['uid']}";
        return $this->database->query($sql);
    }

    function checkFollowing($oid, $uid)
    {
        $sql = "SELECT follow_type FROM org_followers WHERE `oid` = $oid AND `uid` = $uid LIMIT 1";
        $response = $this->database->query($sql);
        if ($response->num_rows > 0) {
            return $response->fetch_assoc()['follow_type'];
        } else {
            return 'follow';
        }
    }

    function followOrganizer($oid, $uid)
    {
        $sql = "INSERT INTO org_followers (oid , uid) VALUES ($oid, $uid)";
        return $this->database->query($sql);
    }

    function changeFollowType($oid, $uid, $follow_type)
    {
        $sql = "UPDATE org_followers SET follow_type = '$follow_type' WHERE oid = $oid AND uid = $uid";
        return $this->database->query($sql);
    }

    function unfollowOrganizer($oid, $uid)
    {
        $sql = "DELETE FROM org_followers WHERE oid = $oid AND uid = $uid";
        return $this->database->query($sql);
    }
}