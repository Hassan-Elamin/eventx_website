
<?php

if (isset($_COOKIE['org_email'])) {
    $output = [];

    if (isset($_REQUEST['request'])) {
        $request = $_REQUEST['request'];
        switch ($request) {
            case 'phase1':
                {
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    
                }
                break;
        }
    } else {
        $output['status'] = 0;
        $output['msg'] = 'you did\n\'t specify your request';
    }
}
