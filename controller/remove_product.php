<?php

require_once("../model/product.php");
extract($_POST);

$result = Product::get_record($delete_id)->delete_record();

if (!$result) header("Location: /views/delete_product?error=1");

else header("Location: /views/delete_product.php?error=0");
