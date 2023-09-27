<!DOCTYPE html>
<html>

<head>
    <title>SiteVitrine - Ajout d'un produit</title>
    <link rel="stylesheet" href="./static/style/tailwind.css">
    <link rel="stylesheet" href="./static/style/custom.css">
    <script src="./static/js/form_check.js" defer></script>
    <script src="./static/js/main.js" defer></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <form enctype="multipart/form-data" method="post" action="add_product.php" class="flex flex-col" id="add-form">
        <label for="product_name">Nom du produit</label>
        <input type="text" name="product_name" class="border-solid rounded-sm border-blue-600">

        <label for="product_price">Prix du produit</label>
        <input type="text" name="product_price" class="number">

        <label for="product_description">Description du produit</label>
        <input type="text" name="product_description">

        <label for="product_illustration">Illustration</label>
        <input type="file" name="product_illustration">

        <input type="submit" name="submitted">
    </form>

    <?php
    extract($_POST);
    if (isset($submitted)) {
        include("config.php");
        $file_content = file_get_contents($filename = $_FILES["product_illustration"]["tmp_name"]);
        $stmt = $db->prepare("INSERT INTO products(image, name, price, description) VALUES (:image, :name, :price, :description)");

        $stmt->bindParam(":image", $file_content);
        $stmt->bindParam(":name", $product_name);
        $stmt->bindParam(":price", $product_price);
        $stmt->bindParam(":description", $product_description);

        $stmt->execute();
    }
    ?>
</body>

</html>