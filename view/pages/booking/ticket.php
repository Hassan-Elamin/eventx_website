<style>
    .ticket-front .ticket-back {
        display: flex;
        flex-direction: column;
    }

    .ticket-front * , .ticket-back * {
        margin: 4px;
    }
</style>

<div class='ticket-front'>
    <strong> * * * * </strong>
    <img src='<?php echo $uploads_dir . $profile_imgs_dir . $data->profile_img ?>' width='25' alt=''>
    <span>
        <strong>user id:</strong>
        <?php echo $data->uid ?>
    </span>
    <span class='text-center'>
        <?php echo $data->username ?>
    </span>
    <span> 
        <strong>Total Paid:</strong>
        <?php echo $tprice ?> $
    </span>
    <div>
        <span class='ex-date'> ticket expire date:
            <?php echo $ticket->expire_date ?>
        </span>
    </div>
</div>

<div class='ticket-back'>
    <h5>For Detalis</h5>
    <?php

    $link = $website_domain . '/view/pages/event_page/event_page.php?eid=' . $eid;
    $filename = $data->title . '.png';
    $filename = str_replace(' ', '_', $filename);
    $root = $_SERVER['DOCUMENT_ROOT'] . '/uploads/eventx/' . $events_imgs_dir . $filename;
    $src_path = $uploads_dir . $events_imgs_dir . $filename;
    QRcode::png($link, $root);

    echo '<img src=\'' . $src_path . '\' alt=\'QR code\' class=\'img-thumbnail\' style=\'width:100px;\'>';
    ?>
    <img src='<?php echo $website_logo ?>' alt='' class='logo'>
    <p class='copyrights'>
        <small>
            &copy; EventX 2021. All rights reserved.
        </small>
    </p>
</div>