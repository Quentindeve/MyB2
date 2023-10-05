<?php

require_once("../model/product.php");
extract($_POST);

$product = Product::get_record($edit_id);
if (isset($product_name))
    $product->name = $product_name;

if (isset($product_price))
    $product->price = $product_price;

if (isset($product_description))
    $product->description = $product_description;

if (isset($product_illustration)) {
    $file = file_get_contents($filename = $_FILES["product_illustration"]["tmp_name"]);
    $product->image = base64_encode($file);
}

$result = $product->save();

if (!$result) header("Location: /views/edit_product?error=1");

else header("Location: /views/edit_product.php?error=0");
