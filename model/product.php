<?php

include("config.php");
include("categories.php");

/// Represents a product from the products table
class Product implements JsonSerializable
{
    public readonly int|null $id;
    public string $name;
    public int $price;
    public string $description;
    public string $image;
    public string $category;
    public int $cat_id;

    function __construct(int $id, string $name, string $price, string $description, string $image, string $category, int $cat_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
        $this->category = $category;
        $this->cat_id = $cat_id;
    }

    /// Returns an array containing all products from the products table
    public static function get_products(): array|false
    {
        global $db;

        // Products
        $req = "SELECT * from products";
        $stmt = $db->prepare($req);
        $result = $stmt->execute();

        if (!$result) return false;

        $returned = array();
        foreach ($stmt->fetchAll() as $row) {
            extract($row);

            $cat = products_categories()[$category];
            array_push($returned, new self($id, $name, intval($price), $description, base64_encode($image), $cat, $category));
        }
        return $returned;
    }

    /// Method from the JsonSerializable interface
    /// We reimplement it because we don't want to serialize megabytes of images when the products_statistics.php endpoint gets called.
    public function jsonSerialize()
    {
        return array(
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "description" => $this->description,
            "category" => $this->category,
        );
    }

    /// Saves record in database.
    /// Returns true on success, false otherwise.
    public function save(): bool
    {
        global $db;

        $select_req = "SELECT * FROM products WHERE id = :id";
        $stmt = $db->prepare($select_req);
        $stmt->bindValue(":id", $this->id);

        $result = $stmt->execute();
        if (!$result) return false;

        if ($stmt->rowCount() == 1) {
            $stmt = $db->prepare(
                "UPDATE products
                SET name = :name,
                image = :image,
                price = :price,
                description = :description,
                category = :category
                WHERE id = :id;"
            );

            $stmt->bindValue(":name", $this->name);
            $stmt->bindValue(":image", base64_decode($this->image));
            $stmt->bindValue(":price", $this->price);
            $stmt->bindValue(":description", $this->description);
            $stmt->bindValue(":id", $this->id);
            $stmt->bindValue(":category", $this->cat_id);

            return $stmt->execute();
        } else {
            $stmt = $db->prepare(
                "INSERT INTO products(name, image, price, description, category) VALUES(
                    :name,
                    :image,
                    :price,
                    :description,
                    :category
                )"
            );
            $stmt->bindValue(":name", $this->name);
            $stmt->bindValue(":image", base64_decode($this->image));
            $stmt->bindValue(":price", $this->price);
            $stmt->bindValue(":description", $this->description);
            $stmt->bindValue(":category", $this->cat_id);

            return $stmt->execute();
        }
    }

    /// Gets the product record of id = $id.
    /// Returns Product instance on success, false otherwise.
    public static function get_record(int $id): self|false
    {
        global $db;

        $req = "SELECT * FROM products WHERE id = :id";
        $stmt = $db->prepare($req);
        $stmt->bindValue(":id", $id);

        $result = $stmt->execute();
        if (!$result) return false;

        $categories = products_categories();

        $row = $stmt->fetch();
        $category = $categories[$row["category"]];
        return new self($row["id"], $row["name"], $row["price"], $row["description"], base64_encode($row["image"]), $category, $row["category"]);
    }

    /// Deletes the record associated with this class instance.
    /// Returns true on success, false otherwise.
    public function delete_record(): bool
    {
        global $db;

        $req = "DELETE FROM products WHERE id = :id";
        $stmt = $db->prepare($req);
        $stmt->bindValue(":id", $this->id);
        return $stmt->execute();
    }

    /// Returns the number of game per category in an associative table of the form
    /// category_name => count
    public static function categories_count(): array|false
    {
        global $db;

        $req = "SELECT products.category, count(*) as count FROM products GROUP BY products.category";

        $stmt = $db->prepare($req);

        if (!$stmt->execute()) return false;

        $categories_count = $stmt->fetchAll();
        $categories = products_categories();

        $tab = array();

        foreach ($categories_count as $row) {
            $id = $row["category"];
            $cat_name = $categories[$id];
            $tab[] = new Category($cat_name, $row["count"]);
        }
        return $tab;
    }
}
