<?php
include_once("../model/products_notes.php");

note_product($_POST["product_id"], $_POST["note"]);

header("Location: /views/product_page.php?product_id=" . $_POST["product_id"]);
