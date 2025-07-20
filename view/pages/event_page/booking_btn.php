<?php

function echoBookingBtn(string $state, bool $soldout)
{
    $btn_name = '';
    $btn_style = '';
    switch ($state) {
        case 'paused':
            $btn_name = 'Event is Paused For Now';
            $btn_style = 'btn-warning disabled';
            break;
        case 'finished':
            $btn_name = 'Event Finished';
            $btn_style = 'btn-success disabled';
            break;
        case 'upcoming': {
            if ($soldout) {
                $btn_name = 'Sold Out';
                $btn_style = 'btn-danger disabled';
            } else {
                $btn_name = 'Booking Now';
                $btn_style = 'btn-danger';
            }
        }
            break;
        case 'continuous': {
            if ($soldout) {
                $btn_name = 'Sold Out';
                $btn_style = 'btn-light disabled';
            } else {
                $btn_name = 'Booking Now';
                $btn_style = 'btn-light';
            }
        }
            break;
    }
    echo ("
    <a href='../booking/booking.php?eid={$GLOBALS['event']->eid}' class='btn $btn_style booking-btn' name='booking' > $btn_name </a>
    ");
}