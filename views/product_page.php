<!DOCTYPE html>
<html>

<?php
require_once("../model/product.php");
$product = Product::get_record($_GET["product_id"]);
?>

<head>
    <title>Site Vitrine - <?php echo $product->name ?></title>
    <link rel="stylesheet" href="/static/style/tailwind.css">
    <link rel="stylesheet" href="/static/style/custom.css">
    <script src="/static/js/main.js" defer></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <h1>
        <?php
        echo $product->name;
        ?>
    </h1>
    <h2>
        <?php
        echo $product->category;
        echo $product->price;
        ?>
    </h2>

    <!-- Image code -->
    <?php
    $image_mime = "image/jpeg";
    $img_code = '<img class="w-32 h-32" src="data:' . $image_mime . ';base64,' . $product->image . '" />';

    echo $img_code;
    ?>

    <p>
        <?php
        echo $product->description;
        ?>
    </p>
    <div>
        <p>Noter sur 5:</p>
        <form action="/controller/note.php" method="POST">
            <input type="hidden" name="product_id" value=<?php echo "'" . $product->id . "'" ?> />
            <input type="number" name="note" max="5" min="0" />
            <input type="submit" />
        </form>
    </div>
</body>

</html>