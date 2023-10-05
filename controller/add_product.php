<?php
require_once("../model/product.php");

extract($_POST);

var_dump($_FILES);
var_dump($_POST);

$file = file_get_contents($filename = $_FILES["product_illustration"]["tmp_name"]);
$product = new Product(-1, $product_name, $product_price, $product_description, base64_encode($file));
$result = $product->save();

if (!$result)
    header("Location: /views/add_product.php?error=1");

else
    header("Location: /views/add_product.php?error=0");
