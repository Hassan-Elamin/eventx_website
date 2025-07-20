<?php

include('data_access/database/php/connect_database.php');
$sql = "SELECT * FROM `features_slides`";
$response = $GLOBALS['database']->query($sql);
$slides = $response->fetch_all(MYSQLI_ASSOC);

foreach ($slides as $slide) {
    echo ("
            <div class=' {$slide['slide_type']}-slide ' >
            <span class='card-title' class='text-center'>{$slide['feature_name']}</span>
            <p>{$slide['description']}</p>
            </div>
            ");
}