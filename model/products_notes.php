<?php

/// This file manages everything that has to do with products_notes table.

require_once("product.php");

/// Notes a product of id = $id with the note $note
/// Asserts that 0 <= $note <= 5
/// Returns true on success, false otherwise
function note_product(int $id, int $note): bool
{
    global $db;

    if ($note < 0 || $note > 5) return false;

    if (!Product::get_record($id)) return false;

    $req = "INSERT INTO products_notes(product_id, note) VALUES(:id, :note)";
    $stmt = $db->prepare($req);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":note", $note);

    return $stmt->execute();
}

/// gets all notes of the product where $product_id = $id and returns them in an array or false on fail.
function notes_by_product_id(int $id): array|false
{
    global $db;

    if (!Product::get_record($id)) return false;

    $req = "SELECT note FROM products_notes WHERE product_id = :id";
    $stmt = $db->prepare($req);
    $stmt->bindValue(":id", $id);
    if (!$stmt->execute()) return false;

    $tab = array();
    foreach ($stmt->fetchAll() as $row) {
        $tab[] = $row["note"];
    }

    return $tab;
}

/// Returns average note of a product where $product_id = $id, null if no notes for this product or false on fail.
function note_avg(int $id): int|null|false
{
    global $db;

    if (!Product::get_record($id)) return false;

    $req = "SELECT AVG(note) as avg FROM products_notes WHERE product_id = :id";
    $stmt = $db->prepare($req);
    $stmt->bindValue(":id", $id);

    if (!$stmt->execute()) return false;

    return $stmt->fetch()["avg"];
}
