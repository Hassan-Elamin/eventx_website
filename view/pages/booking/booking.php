<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php
    include '../../../data_access/database/php/connect_database.php';
    include '../../../data_access/constants.php';
    include '../../../business_logic/data_handlers/events_handler.php';
    include '../../../business_logic/data_handlers/transactions_handler.php';
    include '../../../lib/phpqrcode/qrlib.php';

    $tHandle = new TransactionsHandler($database);

    $eid = $_GET['eid'];

    $ev_handle = new EventsHandler($database);
    $ticket = $tHandle->getTicket($eid);
    $event = $ev_handle->getEvent($eid);
    $data = $tHandle->prepareTransaction($eid, $_COOKIE['uid']);
    ?>

    <?php
    if (is_object($data)) {
        $tprice = $event->ticket_price;
        $tax = $event->ticket_price * $data->tax;
        $commission = $event->ticket_price * $data->commission;
        $services = $event->ticket_price * $data->services;
        $total = $tprice + $tax + $commission + $services;
    }
    ?>
    <?php
    session_start();
    $_SESSION['eid'] = $eid;
    $_SESSION['total'] = $total;

    ?>
    <div class="container py-4 col-8 ">
        <div class="row justify-content-center">
            <div class="flip-card" id="pdf-ticket-view">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <div class="up-body">
                            <strong> * * * * </strong>
                            <span> <?php echo $data->title ?> </span>
                            <img src="<?php echo $uploads_dir . $profile_imgs_dir . $data->profile_img ?>" alt="">
                            <span> user id: <?php echo $data->uid ?> </span>
                            <span class="text-center"> <?php echo $data->username ?> </span>
                        </div>
                        <div>
                            <span> <strong>Total Paid:</strong>
                                $<?php echo $tprice ?>
                            </span>
                        </div>
                        <div>
                            <span class="ex-date"> ticket expire date: <?php echo $ticket->expire_date ?> </span>
                        </div>
                    </div>
                    <div class="flip-card-back">
                        <h5>For Detalis</h5>
                        <?php

                        $link = $website_domain . '/view/pages/event_page/event_page.php?eid=' . $eid;
                        $filename = $data->title . '.png';
                        $filename = str_replace(' ', '_', $filename);
                        $root = $_SERVER['DOCUMENT_ROOT'] . '/uploads/eventx/' . $events_imgs_dir . $filename;
                        $src_path = $uploads_dir . $events_imgs_dir . $filename;
                        QRcode::png($link, $root);

                        echo '<img src="' . $src_path . '" alt="QR code" class="img-thumbnail" style="width:100px;">';
                        ?>
                        <img src="<?php echo $website_logo ?>" alt="" class="logo">
                        <p class="copyrights">
                            <small>
                                &copy; EventX 2021. All rights reserved.
                            </small>
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="card mb-3">
                <h3 class="card-header">Event Ticket Checkout</h3>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $event->title ?></h5>
                </div>
                <img src=" <?php echo ($event->img) ?> " width="100%" alt="">
                <div class="card-body">
                    <div class="card-body d-inline">
                        <span class="text-secondary">
                            Start At : <?php echo $event->start_at ?>
                        </span>
                        <span>&emsp;</span>
                        <span class="text-danger">
                            End At : <?php echo $event->end_at ?>
                        </span>
                    </div>
                </div>
                <ul class="list-group list-group-flush text-start">

                    <li class="list-group-item">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="font-weight-bolder">
                                Ticket Price:
                            </div>
                            <div>
                                <?php echo $tprice ?>$
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="font-weight-bolder">
                                Tax:
                            </div>
                            <div>
                                <?php echo $tax ?>$
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="font-weight-bolder">
                                commission:
                            </div>
                            <div>
                                <?php echo $commission ?>$
                            </div>
                        </div>

                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="font-weight-bolder">
                                Services:
                            </div>
                            <div>
                                <?php echo $services ?>$
                            </div>
                        </div>

                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="font-weight-bolder">
                                Total:
                            </div>
                            <div>
                                <?php echo $total ?>$
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            <?php 
            $content = [
                "title" => $event->title ,
                "uid" => $data->uid, 
                "urImg" => $uploads_dir . $profile_imgs_dir . $data->profile_img,
                "username" => $data->username,
                "tPrice" => $tprice,
                "expire_date" => $ticket->expire_date
            ];
            ?>
            <div class="card-footer text-muted">
                <form action="../../../business_logic/checkout.php" method="post">
                    <input
                        type="hidden"
                        name="content"
                        id="pdf-content"
                        value="<?PHP require './ticket.php' ?>">
                    <button type="submit" name="checkout" class="btn btn-primary"> Checkout </button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        console.log(document.getElementById('pdf-content').value)
    </script>
</body>

</html>