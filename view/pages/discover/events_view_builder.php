<?php

function build_event_card(EventModel $event)
{
    $ev_state = '';
    switch ($event->event_state) {
        case 'paused':
            $ev_state = 'warning';
            break;
        case 'finished':
            $ev_state = 'success';
            break;
        case 'upcoming':
            $ev_state = 'danger';
            break;
        case 'continuous':
            $ev_state = 'light';
            break;
    }
    $eid = $event->eid;
    $c = "http://localhost/uploads/eventx/images/events/";
    $d = "http://localhost/eventx_website/assets/images/moks/jakob-dalbjorn-cuKJre3nyYc-unsplash.jpg";
    $img = $event->img ? $event->img : $d;
    echo ("
    <div class='card col-3  mb-3 {$event->event_state}-eventv-card border-$ev_state eventv-card ' id='$eid'>
    <div class='card-body'>
        <div class='ev-state text-$ev_state'> $event->event_state </div>
        <img src='$img' alt=''> 
        <div>
        <h5 class='card-title'> $event->title </h5>
        <p class='card-text'> $event->description </p>
        </div>
        <div class='cardv-header'>Ticket Price: $event->ticket_price\$ </div>
        </div>
    </div>
    ");
}



$enumValues = [
    'continuous',
    'upcoming',
    'paused',
    'finished'
];

function sortTheEvents(array $events , string $sorttype = 'state'): array
{
    function compareByEnum(EventModel $a, EventModel $b)
    {
        global $enumValues;

        $valueA = array_search($a->event_state, $enumValues);
        $valueB = array_search($b->event_state, $enumValues);

        return $valueA - $valueB;
    };

    function compareByDate (EventModel $a , EventModel $b){
        $dateA = DateTime::createFromFormat('dd/mm/yyyy H', $a->start_at);
        $dateB = DateTime::createFromFormat('d/mm/yyyy H', $b->start_at);

        return $dateB <=> $dateA  ;
    }

    function compareByPrice (EventModel $a , EventModel $b){
        return $a->ticket_price - $b->ticket_price;
    }
    
    if($sorttype === 'date'){
        usort($events, 'compareByDate');
        $events = (array_reverse($events));
    }else if($sorttype === 'price'){
        usort($events, 'compareByPrice');
    }
    usort($events, 'compareByEnum');
    return $events;
}

function build_events_list(array $events_list)
{
    if (!empty($events_list)) {
        foreach ($events_list as $event) {
            build_event_card($event);
        }
    } else {
        echo ("
        <i class='fa-regular fa-face-sad-cry'></i>
        <h2>No events found.</h2>
        ");
    }
}
