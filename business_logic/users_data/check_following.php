<?php

include $_SERVER['DOCUMENT_ROOT'].'/eventx_website/data_access/database/php/connect_database.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    $key = array_key_first($_POST);
    $json = json_decode($key, true);

    $uid = $json["uid"];
    $oid = $json["oid"];
    $request_type = $json['request'];

    if ($request_type === 'check follow') {
        $sql = "SELECT follow_type FROM `org_followers` WHERE `oid` = $oid AND `uid` = $uid LIMIT 1;";
        $response = $GLOBALS['database']->query($sql);
        print_r($response->fetch_assoc()['follow_type']);
    }

}