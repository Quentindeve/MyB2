<?php

/// Only API endpoint of the project
/// Method: GET
/// Parameters:
///    - type: string
///          values: "categories": returns categories statistics.
///                  "notes": returns all notes and average note of each product.
/// Returns: JSON-formatted datas.
/// Try to go to this file with your browser and one of theses parameters, it's quite fun ! 

require_once("../model/product.php");
require_once("../model/categories.php");
require_once("../model/products_notes.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

if ($_GET["type"] == "categories") {

    echo json_encode(Product::categories_count());
} else if ($_GET["type"] == "notes") {
    $products = Product::get_products();

    $response = array();

    foreach ($products as $product) {
        $tab = array();
        $tab["average"] = note_avg($product->id);

        $tab["notes"] = notes_by_product_id($product->id);

        $obj = array(
            "product" => $product,
            "values" => $tab,
        );

        $response[] = $obj;
    }

    echo json_encode($response);
}
