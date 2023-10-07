<!DOCTYPE html>
<html>

<head>
    <title>Site Vitrine - Admin</title>
    <link rel="stylesheet" href="/static/style/tailwind.css">
    <link rel="stylesheet" href="/static/style/custom.css">
    <script src="/static/js/main.js" defer></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <form action="admin.php" method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" />
        <label for="password">Mot de passe</label>
        <input type="password" name="password" />
        <input type="submit" name="submit" value="Se connecter">
    </form>

    <?php
    // Probablement le pire système de connexion que j'ai fait/vu de ma vie
    if (isset($_POST["submit"])) {
        extract($_POST);

        $USERNAME = "admin";
        $PASSWORD = "password";

        if ($username == $USERNAME && $password == $PASSWORD) {
            session_start();
            $_SESSION["admin"] = true;
            echo "<p class=\"text-green-600\"> Connecté !</p>";

            header("Location: /index.php");
            die();
        } else {
            echo "<p class=\"text-red-600\">Erreur: nom d'utilisateur ou mot de passe invalide.</p>";
        }
    }
    ?>
</body>

</html>