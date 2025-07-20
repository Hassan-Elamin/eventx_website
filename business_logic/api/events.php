<?PHP

include '../../data_access/constants.php';
require './api_config.php';

require '../data_handlers/events_handler.php';
require '../data_handlers/categories_handler.php';
require '../data_handlers/organizers_handler.php';
$output = [];
if (isset($_GET['eid'])) {
    $output = [];
    $eid = $_GET['eid'];
    try {
        require '../data_handlers/transactions_handler.php';

        $tHandle = new TransactionsHandler($GLOBALS['database']);
        $evhandler = new EventsHandler($GLOBALS['database']);
        $cat_handler = new Categories_handler($GLOBALS['database']);
        $org_handler = new Organizers_handler();

        $event = $evhandler->getEvent($eid);
        $categories = $cat_handler->getEventCategories($eid);
        $locations = $evhandler->getEventLocations($eid);
        $ticket = $tHandle->getTicket($eid);
        $organizer = $org_handler->getOrganizerById($event->oid, true);

        $output['event'] = $event;
        $output['categories'] = $categories;
        $output['organizer'] = $organizer;
        $output['locations'] = $locations;
        $output['ticket'] = $ticket;
    } catch (Exception $error) {
        $output = [
            "status" => $error->getCode(),
            "message" => $error->getMessage()
        ];
    }

    echo json_encode($output);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['addEvent']) ) {
    $output = [];
    try {

        $output = $_POST;

        $locations = [];

        foreach($_POST as $k => $v){
            if(str_contains($k , 'location')){
                array_push($locations,$v);
                unset($_POST[$k]);
            }
        }

        $output['locations'] = $locations;
        
        // $inputJSON = file_get_contents('php://input');
        // $input = json_decode($inputJSON, true);
        // $output = $input;

        // $org_handler = new Organizers_handler();
        // $cat_handler = new Categories_handler($GLOBALS['database']);
        // $eventsHandler = new EventsHandler($GLOBALS['database']);

        // $output['locations[]'] = explode(',' , $output['locations[]']);
        // $output['categories[]'] = explode(',' , $output['categories[]']);
        
        
    } catch (Exception $error) {
        $output['error'] = $error->getMessage();
    }
    echo json_encode($output);
} else {
    echo json_encode(
        [
            "msg" => 'there is no specific requrest'
        ]
    );
}

