<!DOCTYPE html>
<html>

<head>
    <title>Editer un produit</title>
    <link rel="stylesheet" href="./static/style/tailwind.css">
    <link rel="stylesheet" href="./static/style/custom.css">
    <script src="./static/js/main.js" defer></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <!-- Si l'utilisateur a pressé un bouton pour modifier une colonne -->
    <?php
    include("./config.php");

    if (isset($_POST["edit"])) {
        extract($_POST);
        $filename = $_FILES["product_illustration"]["tmp_name"];
        $file_content = null;

        if ($filename == "") {
            $file_content = base64_decode($image_unedited);
        } else {
            $file_content = file_get_contents($filename);
        }

        $stmt = $db->prepare(
            "UPDATE products
            SET name = :name,
            image = :image,
            price = :price,
            description = :description
            WHERE id = :id;"
        );

        $stmt->bindValue(":name", $product_name);
        $stmt->bindValue(":image", $file_content);
        $stmt->bindValue(":price", $product_price);
        $stmt->bindValue(":description", $product_description);
        $stmt->bindValue(":id", $edit_id);

        $result = $stmt->execute();
        $error = $db->errorCode();

        if (!$result) {
            echo "<p class='text-red-700'>Cette action n'a pas pu être effectuée: $error</p>";
        } else {
            echo "<p class='text-green-600'>Changement fait !</p>";
        }
    }
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

            $request = "SELECT * FROM products";
            foreach ($db->query($request) as $row) {
                extract($row);

                $image = base64_encode($image);
                $image_mime = "image/jpeg";
                $img_code = '<img class="img-table-scale" src="data:' . $image_mime . ';base64,' . $image . '" />';

                echo "
                <tr>
                    <form enctype='multipart/form-data' method='post' action='edit_product.php' class='flex flex-col'>
                        <td>$id</td>
                        <input type='hidden' name='edit_id' value='$id'>
                        <td><input type='text' name='product_name' value='$name' /></td>
                        <td><input type='number' name='product_price' value='$price' /></td>
                        <td><input type='text' name='product_description' value='$description' /></td>
                        <input type='hidden' name='image_unedited' value='$image' />
                        <td class='flex flex-col'>$img_code<input type='file' name='product_illustration'/></td>
                        <td><input type='submit' name='edit' value='Modifier' </td>
                    </form>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>