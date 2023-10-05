<!DOCTYPE html>
<html>

<head>
    <title>Site Vitrine - Nos Produits</title>
    <link rel="stylesheet" href="./static/style/tailwind.css">
    <link rel="stylesheet" href="./static/style/custom.css">
    <script src="./static/js/main.js" defer></script>
    <script src="./static/js/products.js" defer></script>
</head>

<body class="bg-slate-100">
    <?php
    include("header.php");
    ?>

    <div id="sort" class="flex flex-col max-w-lg gap-2 w-fit">
        <p>Filtrer par</p>
        <div class="flex flex-row">
            <p>Nom</p>
            <textarea id="name-filter" rows="1" class="border border-solid border-blue-600 ml-1"></textarea>
        </div>
        <div class="flex flex-row">
            <p>Description</p>
            <textarea id="desc-filter" rows="1" class="border border-solid border-blue-600 ml-1"></textarea>
        </div>
        <div class="flex flex-row">
            <p>Prix</p>
            <textarea id="price-filter" rows="1" class="border border-solid border-blue-600 ml-1"></textarea>
        </div>
        <div class="flex flex-row">
            <p>Trier par: </p>
            <select id="price-sort">
                <option name="desc" class="border border-solid border-blue-600" value="desc">Prix Décroissant</option>
                <option name="asc" class="border border-solid border-blue-600" value="asc">Prix Croissant</option>
            </select>
        </div>
    </div>

    <?php
    include("config.php");

    $stmt = $db->prepare("SELECT * from products");
    $result = $stmt->execute();

    if (!$result) {
        echo "<p class='text-red-700'>Cette action n'a pas pu être effectuée: $error</p>";
    }

    $products = $stmt->fetchAll();

    echo "<div id='cards-container' class='flex flex-row m-5'>";
    foreach ($products as $product) {
        $image = base64_encode($product["image"]);
        $image_mime = "image/jpeg";
        $img_code = '<img class="img-table-scale zoomable" src="data:' . $image_mime . ';base64,' . $image . '" />';

        $name = $product["name"];
        $price = $product["price"];
        $description = $product["description"];

        echo
        "<div class='bg-slate-300 flex flex-col card items-center m p-3 ml-2 mr-2'>
            <span class='p-name'>$name</span>
            $img_code
            <span class='p-desc'>$description</span>
            <span class='p-price'>$price €</span>
        </div>";
    }

    echo "</div>";

    ?>

</body>