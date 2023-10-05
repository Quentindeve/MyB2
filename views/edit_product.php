<!DOCTYPE html>
<html>

<head>
    <title>Editer un produit</title>
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
            require_once("../model/product.php");
            foreach (Product::get_products() as $product) {
                $image_mime = "image/jpeg";
                $img_code = '<img class="img-table-scale" src="data:' . $image_mime . ';base64,' . $product->image . '" />';

                echo "
                <tr>
                    <form enctype='multipart/form-data' method='post' action='/controller/edit_product.php' class='flex flex-col'>
                        <td>$id</td>
                        <input type='hidden' name='edit_id' value='$product->id'>
                        <td><input type='text' name='product_name' value='$product->name' /></td>
                        <td><input type='number' name='product_price' value='$product->price' /></td>
                        <td><input type='text' name='product_description' value='$product->description' /></td>
                        <input type='hidden' name='image_unedited' value='$product->image' />
                        <td class='flex flex-col'>
                            $img_code
                            <input type='hidden' name='MAX_FILE_SIZE' value='9999999' />
                            <input type='file' name='product_illustration'/>
                        </td>
                        <td><input type='submit' name='edit' value='Modifier' </td>
                    </form>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>