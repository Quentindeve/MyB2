<?php

include("config.php");

class Product
{
    public readonly int|null $id;
    public string $name;
    public int $price;
    public string $description;
    public string $image;

    function __construct(int $id, string $name, string $price, string $description, string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
    }

    public static function get_products(): array|false
    {
        global $db;

        $req = "SELECT * from products";
        $stmt = $db->prepare($req);
        $result = $stmt->execute();

        if (!$result) return false;

        $returned = array();
        foreach ($stmt->fetchAll() as $row) {
            extract($row);
            array_push($returned, new self($id, $name, intval($price), $description, base64_encode($image)));
        }
        return $returned;
    }

    // Returns true if save worked, false otherwise
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
                description = :description
                WHERE id = :id;"
            );

            $stmt->bindValue(":name", $this->name);
            $stmt->bindValue(":image", base64_decode($this->image));
            $stmt->bindValue(":price", $this->price);
            $stmt->bindValue(":description", $this->description);
            $stmt->bindValue(":id", $this->id);

            return $stmt->execute();
        } else {
            $stmt = $db->prepare(
                "INSERT INTO products(name, image, price, description) VALUES(
                    :name,
                    :image,
                    :price,
                    :description
                )"
            );
            $stmt->bindValue(":name", $this->name);
            $stmt->bindValue(":image", base64_decode($this->image));
            $stmt->bindValue(":price", $this->price);
            $stmt->bindValue(":description", $this->description);

            return $stmt->execute();
        }
    }

    public static function get_record(int $id): self|false
    {
        global $db;

        $req = "SELECT * FROM products WHERE id = :id";
        $stmt = $db->prepare($req);
        $stmt->bindValue(":id", $id);

        $result = $stmt->execute();
        if (!$result) return false;

        $row = $stmt->fetch();
        return new self($row["id"], $row["name"], $row["price"], $row["description"], base64_encode($row["image"]));
    }

    public function delete_record(): bool
    {
        global $db;

        $req = "DELETE FROM products WHERE id = :id";
        $stmt = $db->prepare($req);
        $stmt->bindValue(":id", $this->id);
        return $stmt->execute();
    }
}
