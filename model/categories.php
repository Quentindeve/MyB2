<?php
require_once("config.php");

/// Represents a category count from the products_category table
class Category
{
    public string $name;
    public int $count;

    function __construct(string $name, int $count)
    {
        $this->name =  $name;
        $this->count = $count;
    }
}

/// Returns an associative table of the shape
/// id_cat => cat_name
/// Where both variables are column names of the products_category table 
/// Or false on fail.
function products_categories(): array|false
{
    global $db;

    // Product_category
    $req = "SELECT * from products_category";
    $stmt2 = $db->prepare($req);
    $result = $stmt2->execute();

    if (!$result) return false;

    $categories = array();
    foreach ($stmt2->fetchAll() as $row) {
        $categories[$row["id_cat"]] = $row["cat_name"];
    }
    return $categories;
}
