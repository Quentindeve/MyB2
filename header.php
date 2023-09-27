<header class="flex flex-row bg-blue-600 items-center gap-5 p-2 sticky top-0 ignore">
    <img src="./static/img/logo.svg" class="w-1/5 h-1/5 ignore" />
    <a href="index.php" class="ignore">Accueil</a>
    <a href="products.php" class="ignore">Produits</a>
    <a href="admin.php" class="ignore">Admin</a>
    <a id="theme-switch" class="ignore"><img src="./static/img/theme.svg" class="ignore" /></a>
    <?php
    session_start();
    extract($_SESSION);

    if (isset($admin) && $admin) {
        echo '<a href="add_product.php" class="ignore">Ajouter un produit</a>';
        echo '<a href="delete_product.php class="ignore">Supprimer un produit</a>';
        echo '<a href="edit_product.php" class="ignore">Modifier un produit</a>';
    }
    ?>
</header>