<?php

include '../../../data_access/database/php/connect_database.php';

$event_title = $_GET['q'];
$str = '%'.$event_title.'%' ;

$res = mysqli_query($database,"SELECT eid , title FROM events WHERE title LIKE '%$event_title%' ");

if($res){
    $data = $res->fetch_all();
    foreach($data as $d ){
        $title  = $d[1];
        $eid = $d[0];
        echo "<a class='text-decoration-none' href='http://localhost/eventx_website/view/pages/event_page/event_page.php?eid=$eid'> <li>  $title </li> </a> "  ;
    }
}else{
    print_r($res);
    echo 'nothing found';
}

