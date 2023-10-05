<!DOCTYPE html>
<html>

<head>
    <title>Supprimer un produit</title>
    <link rel="stylesheet" href="/static/style/tailwind.css">
    <link rel="stylesheet" href="/static/style/custom.css">
    <script src="/static/js/main.js" defer></script>
</head>

<body>
    <?php
    include("header.php");
    ?>
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Prix</td>
                <td>Description</td>
                <td>Image</td>
                <td></td>
            </tr>
        </thead>

        <tbody>
            <?php

            include("../model/product.php");

            foreach (Product::get_products() as $product) {
                $image_mime = "image/jpeg";
                $img_code = '<img class="img-table-scale" src="data:' . $image_mime . ';base64,' . $product->image . '" />';

                echo "
                <tr>
                    <form action='/controller/remove_product.php' method='post'>
                        <td>$id</td>
                        <input type='hidden' name='delete_id' value='$product->id'>
                        <td>$product->name</td>
                        <td>$product->price</td>
                        <td>$product->description</td>
                        <td class='flex flex-col'>$img_code</td>
                        <td><input type='submit' name='delete' value='Supprimer' </td>
                    </form>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>