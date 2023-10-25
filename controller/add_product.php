<?php
require_once("../model/product.php");

extract($_POST);

$file = file_get_contents($filename = $_FILES["product_illustration"]["tmp_name"]);
$product = new Product(-1, $product_name, $product_price, $product_description, base64_encode($file), "", $category);
$result = $product->save();

// If the operation failed
if (!$result)
    header("Location: /views/add_product.php?error=1");

// Else
else
    header("Location: /views/add_product.php?error=0");
