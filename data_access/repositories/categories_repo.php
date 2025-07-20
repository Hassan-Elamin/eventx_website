<?php

class CategoriesRepo
{
    private mysqli $database;

    public function __construct(mysqli $database)
    {
        $this->database = $database;
    }

    function getCategory(int $category_id): array|string
    {
        $sql = "SELECT * FROM `categories` WHERE category_id = $category_id";
        $response = $this->database->query($sql);
        if ($response->num_rows > 0) {
            return $response->fetch_all()[0];
        } else {
            return 'nothing found';
        }
    }

    function getEventCategories($eid): array|string
    {
        $sql = "SELECT categories.category_id,categories.name FROM events\n"
            . "JOIN events_categories ON events.eid = events_categories.eid\n"
            . "JOIN categories ON events_categories.category_id = categories.category_id\n"
            . "WHERE events.eid = $eid";
        $response = $this->database->query($sql);
        if(!is_bool($response)){
            if ($response->num_rows) {
                
                return $response->fetch_all(MYSQLI_ASSOC);
            } else {
                return "there is no categories";
            }
        }else{
            return "there's problem in response";
        }
    }

    function getCategoriesName() {
        $sql = "SELECT `name` FROM `categories` ";
        $response = $this->database->query($sql);
        return $response->fetch_all();
    }

}