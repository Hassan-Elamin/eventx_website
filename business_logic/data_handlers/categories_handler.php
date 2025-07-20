<?php
include("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/models/category.php");
include("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/repositories/categories_repo.php");

class Categories_handler extends CategoriesRepo
{

    public function __construct(mysqli $database)
    {
        parent::__construct($database);
    }

    function getEventCategories($eid): array|string
    {
        $categories = parent::getEventCategories($eid);
        if (gettype($categories) == gettype([])) {
            $cmodel_list = [];
            foreach ($categories as $category_row) {
                $category = getTag($category_row);
                $cmodel_list[] = $category;
            }
            return $cmodel_list;
        } else {
            return 'no categories found';
        }

    }
}