<?php

class TicketsRepo {

    private $database ;

    public function __construct() {
        $this->database = $GLOBALS['database'];
    }

    function getTicket ($eid) {
        $sql = "SELECT * FROM tickets WHERE eid = $eid" ;
        $response = $this->database->query($sql);
        if ($response->num_rows > 0) {
            return $response->fetch_assoc();
        } else {
            return 'nothing found';
        }
    }

    function addTicket ($eid, $expire_date, $price){
        $sql = "INSERT INTO tickets (eid, expire_date, price) VALUES ($eid, '$expire_date', $price)" ;
        $this->database->query($sql);
        return $this->database->insert_id;
    }
}