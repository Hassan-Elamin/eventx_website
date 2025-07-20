<!DOCTYPE html>
<html lang="en">

<head>
    <?php require '../../../includes/head.php' ?>
    <link rel="stylesheet" href="style.css">
    <title> Event Dashboard </title>
</head>

<body>
    <?php
    include $website_path . '/business_logic/data_handlers/events_handler.php';
    $ev_handle = new EventsHandler($database);
    
    $event = $ev_handle->getEvent($_GET['eid']);

    ?>
    <div class="container">
        <?php
        include '../../../includes/app_header/header.php';

        function calcStartDate($date, $end = false)
        {
            $current_date = new DateTime(gmdate('Y-m-d H:i:s', time()));
            $target_date = new DateTime($date);
            $diff = $end ? date_diff($target_date, $current_date) : date_diff($current_date, $target_date);
            $years = $diff->format('%y');
            $months = $diff->format('%m');
            $days = $diff->format('%a');
            $hours = $diff->format('%h');

            $fin_date = '';

            if ($years > 0) {
                $fin_date = $years . ' year(s) ';
            }
            if ($months > 0) {
                $fin_date .= $months . ' month(s) ';
            }
            if ($days > 0) {
                $fin_date .= $days . ' day(s) , ';
            }
            if ($hours > 0) {
                $fin_date .= $hours . ' hour(s) ';
            }
            return $fin_date;


        }
        ?>
        <div class="row text-center my-3">
            <h2> <?php echo $event->title ?> </h2>

            <div>
                <?php
                $date = null;
                $title = '';

                $currentDateTime = (new DateTime(gmdate('Y-m-d H:i:s', time())));
                $s = gmdate('Y-m-d H', time());

                switch ($event->event_state) {
                    case 'upcoming': {
                        $title = 'Remaining Time To Start';
                        $date = calcStartDate($event->start_at);
                    }
                        break;
                    case 'continous':
                        $title = 'Remaining Time Until End';
                        $date = $event->end_at - gmdate('y-m-d H', time());
                        break;
                }

                echo ("
                <h4> $title : $date </h4>
                <h5> {$s} </h5>
                ");

                ?>

            </div>

            <div>
                <?php

                class EventDashboardData {
                    public $sold ;
                    public $remain_tickets ;
                    public $last_checkout ;
                    public $total ;

                    public function __construct($sold = 0 , $remain_tickets = 0, $last_checkout = 'none' , $total = 0) {
                        $this->sold = $sold;
                        $this->remain_tickets = $remain_tickets;
                        $this->last_checkout = $last_checkout;
                        $this->total = $total;
                    }


                    public static function getDashboardData($row) {
                        return new EventDashboardData(
                            $row['Sold'] ?? 0,
                            $row['Remaining Tickets'],
                            $row['last_checkout'] ?? 'none',
                            $row['total'] ?? 0,
                        );
                    }
                }

                $result = $database->query("CALL getEventDashboardData({$event->eid})")->fetch_assoc();
                
                $eventD = EventDashboardData::getDashboardData($result);

                echo ("
                <table class='table event-details-table' >
                <tr class='table-header' >
                <th> Sold </th>
                <th> Remaining </th>
                <th> Last Checkout </th>
                <th> Total Earning </th>
                </tr>
                <tr>
                <td> {$eventD->sold} </td>
                <td> {$eventD->remain_tickets} </td>
                <td> {$eventD->last_checkout} </td>
                <td> {$eventD->total} </td>
                </tr>
                </table>
                ");

                ?>
            </div>
        </div>
    </div>

    <script src="../../../js/jquery-3.7.1.min.js" ></script>
    <script src="../../../js/bootstrap.js" ></script>
</body>

</html>