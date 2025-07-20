<?php

include_once"{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/database/php/connect_database.php";

class organizers_repository {
    private $database ;
    public function __construct() {
        $this->database = $GLOBALS['database'];
    }

    function becomeOrganizer(UserModel $user, $brandName, $bio)
    {
        $query_command = "SELECT `oid` FROM `organizers WHERE email = '{$user->email}'";
        $db = $this->database;
        
        $res = $db->query($query_command);
        print_r($res);
       
        if ($res) {
            return "this email is already exists";
        } else {
            $sql = "";
            $password = $db->query("
            SELECT `password` FROM `users` WHERE `uid` = {$user->uid}
            ")->fetch_assoc()['password'];
            //
            $insert_command = ("
            INSERT INTO `organizers` (`email`, `organization_name`, `bio`, `password`) 
            VALUES ('{$user->email}', '$brandName', '$bio' , '$password')
            ");

            $insert_status = $db->query($insert_command);
            if ($insert_status) {
                $oid = mysqli_insert_id($db);
                return $oid;
            } else {
                return `error process failed`;
            }

        }
    }

    function getOrganizer ($o_email){
        $sql = "SELECT * FROM organizers WHERE `email` = '$o_email'";
        $response = $this->database->query($sql);
        if( $response->num_rows == 1 ){
            return $response->fetch_assoc();
        }else{
            return 'something wrong';
        }
    }

    function getOrganizerById($oid,bool $forview = true) {
        if($forview === true){
            $select = "email , bio  , organization_name";
        }else{
            $select = "*";
        }
        $sql = "SELECT $select FROM organizers WHERE `oid` = $oid";
        $response = $this->database->query($sql);
        if ($response->num_rows == 1) {
            return $response->fetch_assoc();
        } else {
            return 'something wrong';
        }
    }

    function checkOrgAccessbility ($org_email){
        $sql = 'SELECT activated FROM organizers WHERE email = $org_email';
        $response = $this->database->query($sql);
        return $response->fetch_assoc()['activated'];
    }

    function getOrgInfo ($oid){
        $sql = "CALL getOrgData($oid)";
        $response = $this->database->query($sql);
        if ($response->num_rows == 1) {
            return $response->fetch_assoc();
        } else {
            return 'something wrong';
        }
    }

    function isOrganizer (string $email): bool{
        $sql = "SELECT email FROM organizers WHERE email = '$email'";
        $res = $this->database->query($sql) ;
        if($res->num_rows > 0){
            return true ;
        }
        return false; 
    }

    function addOrganizerContacts(int $oid , array $contacts) {
        $sql = 'INSERT INTO `organizers_contacts` (`contact`, `oid`)';
        $values = "";
        foreach($contacts as $c){
            $value = "('$c',$oid)";
            $values .= $value.','; 
        }
        $values = rtrim($values , ',');
        $command = "$sql VALUES $values";
        $res = $this->database->query($command);
        return $res;
    }

    function getOrganizerContacts ($oid){
        $sql = "SELECT contact FROM organizers_contacts WHERE `oid` = $oid";
        $response = $this->database->query($sql);
        $contacts = $response->fetch_all();
        return $contacts ;
    }
}

