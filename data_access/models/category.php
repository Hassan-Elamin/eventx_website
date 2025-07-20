<?php

// tags table
class Category
{
    public $tag_id;
    public $name;

    public function __construct($tag_id, $name)
    {
        $this->tag_id = $tag_id;
        $this->name = $name;
    }
}

function getTag (array $data_row):Category {
    return new Category($data_row['category_id'] ,$data_row['name']);
}