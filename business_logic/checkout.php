<?php
include '../data_access/database/php/connect_database.php';
include './data_handlers/transactions_handler.php';
include './pdfGenerator.php';

if (isset($_POST['checkout'])) {
    session_start();
    $eid = $_SESSION['eid'];
    $total = $_SESSION['total'];
    $uid = $_COOKIE['uid'];

    $transaction_handler = new TransactionsHandler($database);

    $pdfG = new pdfGenerator();

    $result = $transaction_handler->createTransaction($uid, $eid, $total);

    $pdfG->generateTicketPdf(
        base64_encode(
            implode(',', [$eid, $uid, time()])
        ),
        'Event Ticket',
        $_POST['content']
    );

    print_r($result);
    if (is_int($result)) {
        unset($_SESSION['total']);
        unset($_SESSION['eid']);
        echo "<script>alert('Transaction Successful')</script>";
        echo "<script>window.location.href='../index.php'</script>";
        exit();
    } else {
        echo $result;
        sleep(4);
        echo "<script>window.location.href='../view/pages/event_page/event_page.php?eid=$eid'</script>";
        exit();
    }
} else {
    print_r("<script> history.go(-1) </script>");
}
