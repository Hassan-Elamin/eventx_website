<?php

require_once './api_config.php';

if (isset($_POST['action'])) {
    $uid = $_POST['uid'];
    $oid = $_POST['oid'];
    $request = $_POST['action'];
    switch ($request) {
        case 'check-follow': {
            try {
                $sql = "SELECT follow_type FROM `org_followers` WHERE uid = $uid AND oid = $oid";

                $response = $GLOBALS['database']->query($sql);

                if ($response->num_rows > 0) {
                    $output['follow_type'] = $response->fetch_assoc()['follow_type'];
                } else {
                    $output['follow_type'] = 'none';
                }
            } catch (Exception $error) {
                $output['message'] = $error->getMessage();
            }
            echo json_encode($output);
        }
            break;
        case 'unfollow': {
            $output = ["status" => 0];
            try {
                $sql = "DELETE FROM org_followers WHERE uid = $uid AND oid = $oid";
                $response = $GLOBALS['database']->query($sql);

                if ($response) {
                    $output['message'] = 'successfully unfollow';
                    $output['status'] = 1;
                } else {
                    $output['message'] = 'Failed to unfollow';
                }
            } catch (Exception $error) {
                $output['message'] = $error->getMessage();
            }
            echo json_encode($output);
        }
            break;
        case 'follow': {
            $output = [];
            try {
                $sql = "INSERT INTO org_followers (`oid`, `uid`, `follow_type`) VALUES ($oid, $uid, 'following')";
                $response = $GLOBALS['database']->query($sql);

                if ($response) {
                    $output['status'] = 1;
                    $output['message'] = 'Followed successfully';
                } else {
                    $output['status'] = 0;
                    $output['message'] = 'Failed to follow';
                }
            } catch (Exception $error) {
                $output['message'] = $error->getMessage();
            }
            echo json_encode($output);
        }
            break;
        case 'see_first': {
            $output = [];
            $sql = "UPDATE org_followers SET follow_type = 'see_first' WHERE uid = $uid AND oid = $oid ";
            $response = $GLOBALS['database']->query($sql);

            if($response){
                $output['message'] = 'Changed follow type to see first';
            }else{
                $output['message'] = 'Failed to change follow type to see first';
            }

            $output['status'] = $response ? 1 : 0;
            echo json_encode($output);

        }
            break;
        case 'following':{
            $output = [];
            $sql = "UPDATE org_followers SET follow_type = 'following' WHERE uid = $uid AND oid = $oid ";
            $response = $GLOBALS['database']->query($sql);

            if($response){
                $output['message'] = 'Changed follow type to following';
            }else{
                $output['message'] = 'Failed to change follow type to following';
            }

            $output['status'] = $response? 1 : 0;
            echo json_encode($output);
        }break ;
    }
}

// if(isset($_POST['following'])){
//     $uid = $_POST['uid'];
//     $oid = $_POST['oid'];

//     $sql = ("
//     SELECT * FROM `org_followers` WHERE uid = $uid AND oid = $oid ;
//     ");

//     $response = $GLOBALS['database']->query($sql);

//     if($response->num_rows > 0){
//         $output = [];
//         while($row = $response->fetch_assoc()){
//             $output[] = $row;
//         }
//     } else {
//         $output = [];
//     }

//     echo json_encode($output);

// }