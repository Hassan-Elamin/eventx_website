<?PHP
if (!isset($_GET['oid'])) {
    print_r("
    <script> window.location.replace('../../../index.php') </script>
    ");
}
require '../../../business_logic/data_handlers/organizers_handler.php';
require '../../../business_logic/data_handlers/events_handler.php';
require '../../includes/events_view_builder.php';


$oid = $_GET['oid'];

$org_handler = new Organizers_handler();

$org = $org_handler->getOrgInfo($oid);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require "../../includes/head.php";
    $event_handler = new EventsHandler($database);
    $events = $event_handler->getOrganizerEvents($oid);
    ?>
    <link rel="stylesheet" href="../../css/event_card.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?PHP include "../../includes/app_header/header.php"; ?>
        <div class="row">
            <div class="col-md-8">
                <div class="border-rounded" >
                    <img src="<?PHP echo $uploads_dir.$profile_imgs_dir.$org['profile_img'] ?>" width="120" alt="">
                </div>
                <h1><?php echo $org['name'] ?></h1>
                <p><?php echo $org['bio'] ?></p>
                <p><?php echo $org['email'] ?></p>
            </div>
        </div>
        <div class="row">
            <h2>Events</h2>
            <?php
            build_events_list($events);
            ?>
        </div>
    </div>
    </div>
    </div>

    <script src="../../js/jquery-3.7.1.min.js"></script>
    <script src="../../js/bootstrap.bundle.js"></script>
</body>

</html>