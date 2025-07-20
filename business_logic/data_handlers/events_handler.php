<?php
require $_SERVER['DOCUMENT_ROOT'] . '/eventx_website/data_access/models/event.php';
include $_SERVER['DOCUMENT_ROOT'] . '/eventx_website/data_access/repositories/events_repo.php';

class EventsHandler
{
    private EventsRepository $repo;
    public function __construct(mysqli $database)
    {
        $this->repo = new EventsRepository($database);
    }

    public function convertToEventList(array $rows)
    {
        $events = [];
        foreach ($rows as $row) {
            $event = EventModel::fromMySqlRow($row);
            $events[] = $event;
        }
        return $events;
    }

    public function getEvent($eid)
    {
        $row = $this->repo->getEvent($eid);
        if (!is_string($row)) {
            return EventModel::fromMySqlRow($row);
        } else {
            return $row;
        }
    }

    public function getOrgEvent ($eid){

    }

    function getMainEvent()
    {
        $row = $this->repo->getMainEvent();
        return EventModel::fromMySqlRow($row);
    }

    public function getAllEvents()
    {
        $data_list = $this->repo->getAllEvents();
        return $this->convertToEventList($data_list);
    }

    public function getFilteredEvents($categories, $uid)
    {
        $response = $this->repo->getFilteredEvents($categories ?? [], $uid);
        if(is_array($response)){
            return $this->convertToEventList($response);
        }else{
            return $response;
        }
    }

    public function getOrganizerEvents($oid)
    {
        $data_list = $this->repo->getOrganizerEvents($oid);
        if (!is_string($data_list)) {
            return $this->convertToEventList($data_list);
        } else {
            return $data_list;
        }
    }

    public function getEventLocations ($eid){
        $response = $this->repo->getEventLocations($eid);
        if(is_array($response)){
            return $response;
        } else{
            return $response;
        }
    }

}



$event_handler = new EventsHandler($GLOBALS['database']);