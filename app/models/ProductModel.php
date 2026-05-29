<?php

class ProductModel
{
    private $conn;

    private $table_name = "product";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /* =========================
       GET ALL PRODUCTS
    ========================== */

    public function getProducts()
    {
        $query = "SELECT p.*,
                         c.name as category_name
                  FROM product p
                  LEFT JOIN category c
                  ON p.category_id = c.id
                  ORDER BY p.id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
       GET PRODUCT BY ID
    ========================== */

    public function getProductById($id)
    {
        $query = "SELECT *
                  FROM product
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /* =========================
       ADD PRODUCT
    ========================== */

    public function addProduct(
        $name,
        $description,
        $price,
        $image,
        $category_id
    )
    {
        $query = "INSERT INTO product
                (name, description, price, image, category_id)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            $name,
            $description,
            $price,
            $image,
            $category_id
        ]);
    }

    /* =========================
       UPDATE PRODUCT
    ========================== */

    public function updateProduct(
        $id,
        $name,
        $description,
        $price,
        $image,
        $category_id
    )
    {
        $query = "UPDATE product
                SET
                    name = ?,
                    description = ?,
                    price = ?,
                    image = ?,
                    category_id = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            $name,
            $description,
            $price,
            $image,
            $category_id,
            $id
        ]);
    }

    /* =========================
       DELETE PRODUCT
    ========================== */

    public function deleteProduct($id)
    {
        $query = "DELETE FROM product
                WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([$id]);
    }
}