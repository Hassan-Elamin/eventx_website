<?php
class EventsRepository
{
    private $database;

    function __construct(mysqli $database)
    {
        $this->database = $database;
    }

    function getEvent($eid)
    {
        $sql = "SELECT * FROM `events` WHERE eid = $eid LIMIT 1";
        $res = $this->database->query($sql);
        if ($res->num_rows > 0) {
            return $res->fetch_assoc();
        } else {
            return 'no Event found';
        }
    }

    function getMainEvent()
    {
        $sql = "SELECT * FROM `events` ORDER BY start_at ASC LIMIT 1";
        $res = $this->database->query($sql);
        if ($res->num_rows > 0) {
            return $res->fetch_assoc();
        } else {
            return 'nothing found';
        }
    }

    function getAllEvents()
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/eventx_website/data_access/commands/select.php");
        $response = $this->database->query(getAllEventsLine());
        if ($response->num_rows > 0) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return 'nothing found';
        }
    }

    public function getFilteredEvents($categories, $uid)
    {
        $sql = "SELECT * FROM events WHERE ";
        if (!empty($uid)) {
            $sql .= "oid IN (SELECT oid FROM org_followers WHERE uid = $uid)";
        }
        if (!empty($categories)) {
            echo(' i am here');
            $arr = [];
            foreach ($categories as $category) {
                $arr[] = "'" . $category . "'";
            }
            $sql = str_contains($sql, 'uid') ? $sql .= ' AND' : $sql;
            $sql .= " eid IN (SELECT eid FROM events_categories JOIN categories ON events_categories.category_id = categories.category_id WHERE categories.name IN (" . implode(',', $arr) . "))";
        }
        $response = $this->database->query($sql);
        if ($response->num_rows > 0) {
            $data = $response->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            return 'nothing found';
        }
    }

    function getOrganizerEvents($organizer_id)
    {
        $response = $this->database->query("SELECT * FROM `events` WHERE oid = $organizer_id");
        if ($response->num_rows > 0) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return "There's no events Yet";
        }
    }

    public function getEventLocations($eid)
    {
        $sql = "SELECT location FROM event_locations WHERE eid = $eid ";
        $response = $this->database->query($sql);
        $locations = $response->fetch_all(MYSQLI_ASSOC);
        return $locations;
    }

    function getEventsByCategory($category_name)
    {
        $sql = ("SELECT * FROM `events` JOIN events_categories ON events.eid = events_categories.eid
JOIN categories ON categories.category_id = events_categories.category_id 
WHERE `name` = '$category_name' ;");
        $response = $this->database->query($sql);
        if ($response->num_rows > 0) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return 'nothing found';
        }
    }

    public function getFollowingOrgEvents($uid)
    {
        $sql = "SELECT * FROM org_followers JOIN events ON events.oid = org_followers.oid WHERE uid = $uid;";
        $response = $this->database->query($sql);
        if ($response->num_rows > 0) {
            return $response->fetch_all(MYSQLI_ASSOC);
        } else {
            return 'nothing found';
        }
    }
}
