<?php
include ("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/models/user.php");
include("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/repositories/users_repo.php");

class UserHandler extends UsersRepository {
    public function __construct(mysqli $database)
    {
        parent::__construct($database);
    }
    
    function getUser($email , $password){
        $response = parent::getUser($email,$password);
        
        if(is_string($response)){
            return $response;
        }else {
            return UserModel::fromMysqlRow($response);
        }
    }

    function getUserById (int $uid){
        $response = parent::getUserById($uid);
        return UserModel::fromMysqlRow($response);
    }

    function updateUserImage($profile_img) {
        include "{$_SERVER['DOCUMENT_ROOT']}/eventx_website/business_logic/image_uploader.php";

        
    }

}

