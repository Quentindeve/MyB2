<?php

$db = create_db();

function create_db()
{
    try {
        $database = new PDO(
            "mysql:host=172.17.0.2;dbname=b2;charset=utf8",
            "root",
            "password",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING],
        );
        return $database;
    } catch (Exception $e) {
        $message = $e->getMessage();
        echo "<p class=\"text-red-600\"> $message </p>";
        exit(-1);
    }
}
