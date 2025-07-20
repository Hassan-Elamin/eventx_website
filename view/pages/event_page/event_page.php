<?php
include_once('../../../data_access/database/php/connect_database.php');
include('../../../business_logic/data_handlers/organizers_handler.php');
include('../../../business_logic/data_handlers/user_handler.php');
include('../../../business_logic/data_handlers/categories_handler.php');
include('../../../business_logic/data_handlers/events_handler.php');
include('../../../data_access/constants.php');

if (!isset($_GET['eid'])) {
    header('location:../error_pages/404.php');
}

$eid = $_GET['eid'];

$event = $event_handler->getEvent($eid);

if (is_string($event)) {
    header('location:../error_pages/notEvent.php');
}

if (isset($_COOKIE['org_email'])) {
}

$userh = new UserHandler($database);
if (isset($_COOKIE['uid'])) {
    $user = $userh->getUserById($_COOKIE['uid']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="event_page_style.css">
    <link rel="stylesheet" href="../../css/loader.css">

    <title>Event</title>
</head>

<body>
    <div class="images_carousal d-none">
        <img src="">
        <div class="image-end"></div>
    </div>
    <div class="container col-12 ev-page d-none">
        <div class="event_details">
            <div class="row">
                <div class="d-flex flex-row align-items-center justify-content-between py-2">
                    <div class="ev_title">
                        <h3 class="cute-font-regular" id="title"></h3>
                    </div>
                    <div class="text-end">
                        <strong class="ticket-price my-2 d-none"></strong>
                        <?php
                        require "./booking_btn.php";
                        echoBookingBtn($event->event_state, false);
                        ?>
                    </div>
                </div>
            </div>

            <div class="event-state">
                <span id="event-state-type"></span>
            </div>
            <br>

            <div class="d-flex flex-row justify-content-around align-items-center event-dates">
                <div class="text-light">
                    <h4>start in</h4>
                    <h5>
                        <?php echo $event->start_at ?>
                    </h5>
                </div>
                <div class="text-success">
                    <h4>finish in</h4>
                    <h5>
                        <?php echo $event->end_at ?>
                    </h5>
                </div>
            </div>
            <hr>
            <div class="row">
                <h3>Details</h3>
                <p class="event-details">
                </p>
            </div>
            <div class="event_locations d-none">
                <h3>Event Locations</h3>
                <p></p>
            </div>
            <hr>
            <div>
                <h3>Categories</h3>
                <div class="categories-block"></div>
            </div>
            <div class="org-details">
                <h3>Organizer</h3>
                <div class="d-flex flex-column align-items-center org-profile">
                    <a href="">
                        <div class="org-profile-img">
                            <img src="../../../assets/images/no_image_user.png" alt="">
                        </div>
                    </a>
                    <span class="org-name"></span>
                    <span class="org-email"></span>
                    <div>
                        <button type="submit" id="follow_button" name="follow_btn"
                            class="btn btn-info d-none followActionOptionBtn">Follow</button>
                        <div class="dropdown follow-options d-none">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="followActionsMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="followActionsMenuButton">
                            </ul>
                        </div>
                        </form>
                    </div>
                </div>
                <br>

            </div>
        </div>
    </div>

    <div class="loader">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <script>

    </script>
    <script src="../../js/jquery-3.7.1.min.js"></script>
    <script src="../../js/bootstrap.bundle.js"></script>
    <script src="../../js/api_config.js"></script>
    <script src="../../js/notifier.js"></script>

    <script>
        var notifier = new Notifier("../../css/notify_bar.css");
    </script>
    <script src="../../js/follow_controller.js"></script>
    <script src="script.js"></script>
    <script>
        let start_date = new Date("<?PHP echo $event->start_at ?>")
        let end_date = new Date("<?PHP echo $event->end_at ?>")

        setInterval(() => {
            let current = new Date();

            let dateDiff = start_date - current;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(dateDiff / (1000 * 60 * 60 * 24));
            var hours = Math.floor((dateDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((dateDiff % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((dateDiff % (1000 * 60)) / 1000);


            // console.log(days + ' ' + hours + ' ' + minutes + ' ' + seconds)
        }, 1000)
    </script>

</body>

</html>