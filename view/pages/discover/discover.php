<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="discover_page_style.css">
    <link rel="stylesheet" href="../../css/event_card.css">
    <?php

    include '../../../data_access/database/php/connect_database.php';
    require '../../../business_logic/data_handlers/events_handler.php';
    require '../../../business_logic/data_handlers/categories_handler.php';
    include '../../includes/events_view_builder.php';
    ?>
    <title>Discover</title>
</head>

<body>
    <?php
    include '../../includes/app_header/header.php';
    ?>
    <section>
        <?php
        $evHandler = new EventsHandler($database);

        $m_ev = $evHandler->getMainEvent();
        if (isset($_GET['following']) || isset($_GET['category'])) {
            $u = isset($_GET['following']) ? $_COOKIE['uid'] : null;
            if (isset($_GET['category'])) {
                $selected_categories = [
                    $_GET['category']
                ];
            }
            $data = $evHandler->getFilteredEvents($selected_categories, $u);
            $events = is_array($data) ? $data : [];
        } else {
            $events = $evHandler->getAllEvents();
        }

        $events = sortTheEvents($events, $_GET['sort'] ?? 'state');
        $categoriesHandle = new Categories_handler($database);
        $categories = $categoriesHandle->getCategoriesName();

        $selected_category = '';

        $ev_sort = $_GET['sort'] ?? 'event state';
        ?>
        <!-- TODO: change it  -->
        <main id="main-event">
            <div id="ev-img">
                <img src="<?php echo ($m_ev->img); ?>" alt="">
            </div>
            <div class="event-interface text-end ">
                <h1><?php echo $m_ev->title ?></h1>
                <p> <?php echo $m_ev->description ?> </p>
                <button class="btn btn-light m-ev-btn" id='<?php echo $m_ev->eid; ?>'>Enroll Now</button>
            </div>
        </main>
    </section>
    <!-- the menu of filters -->
    <section class='container filter-menu'>
        <div class="btn-group filter-btn" id="sort-filter" role="group" aria-label="Button group with nested dropdown">
            <div class="" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item state-sort-item">starting date</a>
                    <a class="dropdown-item state-sort-item">event state</a>
                    <a class="dropdown-item state-sort-item">price</a>
                </div>
            </div>
            <button type="button" class="btn btn-primary">
                sort by: <?php echo $ev_sort ?>
            </button>
            <button class="btn btn-danger cancel-btn" id="sort-cancel"> cancel </button>
        </div>
        <!--following check box-->


        <div class="btn-group filter-btn category-options" role="group" aria-label="Button group with nested dropdown">
            <div class="" role="group">
                <button id="btnGroupDrop3" type="button" class="btn btn-primary dropdown-toggle"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop3">
                    <?php
                    for ($i = 0; $i < count($categories); $i++) {
                        $c = $categories[$i][0];
                        echo ('<a class="dropdown-item category-sort-item">' . $c . '</a>');
                    }
                    ?>
                </div>
            </div>
            <button type="button" class="btn btn-primary">
                <?php echo ($_GET['category'] ?? 'select category') ?>
            </button>
            <button class="btn btn-danger cancel-btn" id="category-cancel"> cancel </button>
        </div>
        <?php
        if (isset($_COOKIE['uid'])) {
            print_r("
            <div class='d-flex flex-row align-items-center p-1' id='followCheckBox'>
            <div class='form-check'>
                <input class='form-check-input' name='followCheck' type='checkbox' value='true' id='followingCheck'>
                <label class='form-check-label' for='followingCheck'>
                    Your Following
                </label>
            </div>
        </div>
            ");
        }
        ?>
        <a href="#">reset</a>
    </section>
    <section class="row cards-grid-view" id='events-view'>
        <?php
        build_events_list($events);
        ?>
    </section>

    <script src="../../js/jquery-3.7.1.min.js"></script>

    <script src="../../js/bootstrap.bundle.js"></script>
    <script src="../../includes/app_header/search-bar.js"></script>
    <script src="./discover_pg_script.js"></script>

    <script>
        
    </script>
</body>

</html>