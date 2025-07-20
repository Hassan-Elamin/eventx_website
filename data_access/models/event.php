<?php
// events table
class EventModel
{
    public $eid;
    public $title;
    public $description;
    public $start_at;
    public $end_at;
    public $details;
    public string $event_state;
    public $ticket_price;
    public $oid;
    public $img ;

    public function __construct($eid, $title, $description, $start_at, $end_at, $details, $event_state, $ticket_price, $oid,$img)
    {
        $this->eid = $eid;
        $this->title = $title;
        $this->description = $description;
        $this->start_at = $start_at;
        $this->end_at = $end_at;
        $this->details = $details;
        $this->event_state = $event_state;
        $this->ticket_price = $ticket_price;
        $this->oid = $oid;
        $this->img = $img; 
    }

    public static function fromMySqlRow(array $row): EventModel
    {
        return new EventModel(
            $row['eid'],
            $row['title'],
            $row['description'],
            $row['start_at'],
            $row['end_at'],
            $row['details'],
            $row['event_state'],
            $row['ticket_price'],
            $row['oid'],
            $row['img'] ? ($GLOBALS['uploads_dir'].$GLOBALS['events_imgs_dir'].$row['img'])
            : null 
        );
    }
}