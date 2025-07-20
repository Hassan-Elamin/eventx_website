<?php 

function addEvent ($title,$description,$start_at,$end_at , $details , $location , $event_state , $ticket_price){
    return "INSERT INTO `events` 
    (`title`,`description`,`start_at`,`end_at`,`details`,`location`,`event_state`,`ticket_price`) 
    VALUES ($title, $description, $start_at, $end_at, $details, $location, $event_state, $ticket_price)"; 
};

function addUser ($email,$username,$birthdate,$password){
    return "INSERT INTO `users` 
    (`email`, `username`, `birthdate`, `password`) 
    VALUES ($email,$username, $birthdate, $password)
    ";
}

function addTicket ($uid , $eid , $event_rules , $event_date){
    return "INSERT INTO `tickets` 
    (`uid`, `eid`, `booking_date`, `event_rules`, `event_date`, `ticket_price`) 
    VALUES ($uid, $eid, current_timestamp(), $event_rules, $event_date, 
    (SELECT ticket_price FROM events WHERE eid = $eid )
    )
";
}

