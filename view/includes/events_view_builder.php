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
    $d = "http://localhost/eventx_website/assets/images/moks/jakob-dalbjorn-cuKJre3nyYc-unsplash.jpg";
    $img = $event->img ?? $d;
    echo ("
    <div class='card col-4  mb-3 {$event->event_state}-eventv-card border-$ev_state eventv-card ' id='$eid'>
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

function sortTheEvents(array $events, string $sorttype = 'state'): array
{
    function compareByEnum(EventModel $a, EventModel $b)
    {
        global $enumValues;

        $valueA = array_search($a->event_state, $enumValues);
        $valueB = array_search($b->event_state, $enumValues);

        return $valueA - $valueB;
    }
    ;

    function compareByDate(EventModel $a, EventModel $b)
    {
        $dateA = DateTime::createFromFormat('dd/mm/yyyy H', $a->start_at);
        $dateB = DateTime::createFromFormat('d/mm/yyyy H', $b->start_at);

        return $dateB <=> $dateA;
    }

    function compareByPrice(EventModel $a, EventModel $b)
    {
        return $a->ticket_price - $b->ticket_price;
    }

    if ($sorttype === 'date') {
        usort($events, 'compareByDate');
        $events = (array_reverse($events));
    } else if ($sorttype === 'price') {
        usort($events, 'compareByPrice');
    }
    usort($events, 'compareByEnum');
    return $events;
}

function build_events_list($events_list)
{
    if (!empty($events_list) === true) {
        foreach ($events_list as $event) {
            build_event_card($event);
        }
        $link = $GLOBALS['website_domain']."/view/pages/event_page/event_page.php" ;
        echo ("
        <script>
        let event_cards = document.getElementsByClassName('eventv-card');

        function navigateToEvent(eid) {
            window.location.href = '$link?eid=' + eid;
        }
            for (let i = 0; i < event_cards.length; i++) {
        event_cards[i].addEventListener('click', (event) => {
            let id = event.currentTarget.id;
            navigateToEvent(parseInt(id))
        }
        )
    }
        </script>
        ");
    } else {
        echo ('
        <div class="row no-events-found-model">
        <i class="fa-solid fa-face-sad-cry m-4"></i>
        <h2>No Events Found</h2>
        </div>
        ');
    }
}
