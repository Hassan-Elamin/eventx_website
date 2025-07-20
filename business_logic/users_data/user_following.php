<?php

include '../../data_access/database/php/connect_database.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    $key = array_key_first($_POST);
    $json = json_decode($key, true);

    $uid = (int)$json["uid"];
    $oid = (int)$json["oid"];
    $request_type = $json['request'];

    if ($request_type === 'follow') {
        $sql = "INSERT INTO org_followers (`oid` ,`uid`) VALUES ($oid, $uid)";
        $response = $database->query($sql);
        echo ('following') ;
    } 

}