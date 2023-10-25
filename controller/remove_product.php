<?php

require_once("../model/product.php");
extract($_POST);

$result = Product::get_record($delete_id)->delete_record();

// If the operation failed
if (!$result) header("Location: /views/delete_product?error=1");

// Else if the operation is successful
else header("Location: /views/delete_product.php?error=0");
