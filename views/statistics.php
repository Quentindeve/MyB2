<!DOCTYPE html>
<html>

<head>
    <title>Site Vitrine - Statistiques</title>
    <link rel="stylesheet" href="/static/style/tailwind.css">
    <link rel="stylesheet" href="/static/style/custom.css">
    <script src="/static/js/main.js" defer></script>
    <script src=" https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js "></script>
    <script src="/static/js/statistics.js" defer></script>
</head>

<body>
    <?php
    include("header.php");
    ?>
    <div id="container" class="flex flex-row flex-auto flex">
        <canvas id="notes-chart" width="200" height="200"></canvas>
        <canvas id="categories-chart" width="200" height="200"></canvas>
    </div>
</body>

</html>