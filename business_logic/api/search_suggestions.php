<?php

require_once './api_config.php';

try {
    $output = [
        'status' => 0
    ];

    $event_title = $_GET['q'];

    if (empty($event_title)) {
        $output['msg'] = 'Event title is required.';
    } else {
        $str = '%' . $event_title . '%';

        $res = mysqli_query($database, "SELECT eid , title FROM events WHERE title LIKE '%$event_title%' ");

        if ($res->num_rows > 0) {
            $output['status'] = 1;
            $output['suggestions'] = $res->fetch_all(MYSQLI_ASSOC);
        } else {
            $output['msg'] = 'nothing found';
        }
    }
} catch (Exception $error) {
    $output = [
        'status' => -1,
        'msg' => $error->getMessage()
    ];
}

echo json_encode($output);