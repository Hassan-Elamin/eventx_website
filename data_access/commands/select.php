<?php

function getAllEventsLine()
{
    return "SELECT * FROM events";
}

function getEventByIdLine($eid)
{
    return "SELECT * FROM events WHERE eid = $eid LIMIT 1";
}

