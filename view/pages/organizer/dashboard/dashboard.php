<!DOCTYPE html>
<html lang="en">

<head>
    <?PHP require '../../../includes/head.php' ?>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="container text-center py-2">
        <?php
        if (isset($_COOKIE['org_email'])) {
            include "../../../../business_logic/data_handlers/organizers_handler.php";
            $org_handler = new Organizers_handler();
            $org = $org_handler->getOrganizer($_COOKIE['org_email']);
        } else {
            echo ("
        <p>
        if you want to become an Organizer , you'll need to sign in as user first
        once you signed in as user , you can switch your account to an organizer account
        </p>
        <a href='../../signin/signin.php'>go to login page</a>
        ");
        }
        ?>
        <div class="row">
            <h1>
                <?php echo $org->name; ?>
            </h1>
            <p>
                <?php echo $org->email; ?>
            </p>

        </div>
        <div class="row justify-content-evenly my-2">
            <h4>Control Panel</h4>
            <div class="row justify-content-evenly">
                <a href="../add_event/add_event.php" class="btn custom-card option-card" >
                    <i class="fa-solid fa-plus"></i>
                    <span class='card-title'> Add New Event </span>
                </a>
                <button class="btn custom-card option-card">
                    <i class="fa-regular fa-circle-up"></i>
                    <span class='card-title'> Update Organization Account </span>
                </button>
                <button class="btn custom-card option-card">
                    <i class="fa-solid fa-plus"></i>
                    <span class='card-title'> Add New Event </span>
                </button>
                <button class="btn custom-card option-card">
                    <i class="fa-solid fa-life-ring"></i>
                    <span class='card-title'> Contact with us </span>
                </button>
            </div>
        </div>
        <?php
        include './event_insert_modal.php';
        ?>
        <div class="row justify-content-center">
            <?php
            if ($org->activated) {
                include "../../../../business_logic/data_handlers/events_handler.php";
                include "../../discover/events_view_builder.php";

                $events = $event_handler->getOrganizerEvents($org->oid);
                build_events_list($events);
            } else {
                $account_status = $org->activated ? 'active' : 'disactive';
                $class = ($account_status === 'active') ? 'success' : 'warning';
                $title = ($account_status === 'disactive') ? 'your account is not active yet' : 'your account is active';
                echo "<h4 class='text-$class'>$title</h4>";
            }
            ?>
        </div>
    </div>
    <script src="../../../bootstrap/js/bootstrap.js"></script>
    <script src="./script.js"></script>
</body>

</html>