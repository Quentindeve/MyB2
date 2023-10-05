<!DOCTYPE html>
<html>

<head>
    <title>SiteVitrine - Ajout d'un produit</title>
    <link rel="stylesheet" href="/static/style/tailwind.css">
    <link rel="stylesheet" href="/static/style/custom.css">
    <script src="/static/js/form_check.js" defer></script>
    <script src="/static/js/main.js" defer></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <form enctype="multipart/form-data" method="post" action="/controller/add_product.php" class="flex flex-col" id="add-form">
        <label for="product_name">Nom du produit</label>
        <input type="text" name="product_name" class="border-solid rounded-sm border-blue-600">

        <label for="product_price">Prix du produit</label>
        <input type="text" name="product_price" class="number">

        <label for="product_description">Description du produit</label>
        <input type="text" name="product_description">

        <input type="hidden" name="MAX_FILE_SIZE" value="999999999" />
        <label for="product_illustration">Illustration</label>
        <input type="file" name="product_illustration">

        <input type="submit" name="submitted">
    </form>
</body>

</html>