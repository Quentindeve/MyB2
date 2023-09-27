<!DOCTYPE html>
<html>

<head>
    <title>Supprimer un produit</title>
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

    if (isset($_POST["delete"])) {
        extract($_POST);

        $stmt = $db->prepare(
            "DELETE FROM products
            WHERE id = :id;"
        );

        $stmt->bindValue(":id", $delete_id);

        $result = $stmt->execute();
        $error = $db->errorCode();

        if (!$result) {
            echo "<p class='text-red-700'>Cette action n'a pas pu être effectuée: $error</p>";
        } else {
            echo "<p class='text-green-600'>Suppression faite !</p>";
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
                    <form action='delete_product.php' method='post'>
                        <td>$id</td>
                        <input type='hidden' name='delete_id' value='$id'>
                        <td>$name</td>
                        <td>$price</td>
                        <td>$description</td>
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