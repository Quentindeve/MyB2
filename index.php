<!DOCTYPE html>
<html>

<head>
    <title>Site Vitrine</title>
    <link rel="stylesheet" href="./static/style/tailwind.css">
    <link rel="stylesheet" href="./static/style/custom.css">
    <script src="./static/js/main.js" defer></script>
    <script src="./static/js/caroussel.js" defer></script>
    <link rel="stylesheet" href="./static/style/caroussel.css">
</head>

<body class="bg-slate-100">
    <?php
    include("views/header.php");
    ?>

    <div id="description" class="mt-5 flex flex-col items-center">
        <h1 class="text-3xl">Bienvenue sur le site de notre magasin !</h1>
        <p class="text-xl">
            Retrouvez toutes vos licences de jeu-vidéo préférées sur notre magasin !
        </p>
        <div class="carousel-container">
            <h1 class="text-2xl text-center mt-4">Nos produits phares</h1>
            <div class="carousel">
                <?php
                require_once("model/product.php");

                echo "<script>";
                $i = 0;
                $first = null;
                foreach (Product::get_products() as $product) {
                    $image = $product->image;
                    $image_mime = "image/jpeg";
                    $img_code = 'data:' . $image_mime . ';base64,' . $image;
                    if ($i == 0) {
                        $first = $img_code;
                    }

                    echo "const image$i = \"$img_code\";";
                    $i += 1;
                }
                echo "</script>";
                echo
                "
            <img src=$first />
            "
                ?>
            </div>
            <div id="carousel-left" class="carousel-control left">&#10094;</div>
            <div id="carousel-right" class="carousel-control right">&#10095;</div>
        </div>
    </div>

    <div id="coords" class="mt-5 flex flex-col items-center">
        <h1 class="text-3xl">Où nous trouver ?</h1>
        <iframe id="map-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2555.5400723327434!2d3.227556776540734!3d50.169737771539886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c2bb7c994884cd%3A0xfeb22da9eb2d0823!2sLTPES%20Ensemble%20Saint-Luc!5e0!3m2!1sfr!2sfr!4v1694589500673!5m2!1sfr!2sfr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        <div id="open">
            <p class=" text-xl mb-1">Horaires d'ouverture</p>
            <ul class="text-l flex flex-col mb-1">
                <li>Lundi: 8h-12h 13h-18h</li>
                <li>Mardi: 8h-12h 13h-18h</li>
                <li>Mercredi: 8h-12h 13h-18h</li>
                <li>Jeudi: 8h-12h 13h-18h</li>
                <li>Vendredi: 8h-12h 13h-18h</li>
                <li>Samedi: 8h-12h 13h-18h</li>
                <li>Dimanche: 8h-12h 13h-18h</li>
            </ul>
        </div>
        <p class="text-xl">Contact: <a href="mailto:enflure@gmail.com">enflure@gmail.com</a></p>
    </div>
</body>

</html>