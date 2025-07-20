<?php

// users table
class UserModel
{
    public $uid;
    public $email;
    public $username;
    public $birthdate;
    public $password;
    public $profile_img;

    public function __construct($uid, $email, $username, $birthdate, $password, $img)
    {
        $this->uid = $uid;
        $this->email = $email;
        $this->username = $username;
        $this->birthdate = $birthdate;
        $this->password = $password;
        $this->profile_img = empty($img) ? $GLOBALS['uploads_dir'] . $GLOBALS['defaults_imgs_dir'] . 'no_image_user.png'
            : $GLOBALS['uploads_dir'] . $GLOBALS['profile_imgs_dir'] . $img;
    }

    public static function fromMysqlRow($row)
    {
        return new UserModel(
            $row['uid'],
            $row['email'],
            $row['username'],
            $row['birthdate'],
            $row['password'],
            $row['profile_img'],
        );
    }
}
