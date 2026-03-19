<?php
class Category {
    private $id;
    private $name;
    private $conn;

    public function __construct($conn, $id = null, $name = null) {
        $this->conn = $conn;
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Lấy tất cả categories
    public function getAllCategories() {
        $sql = "SELECT * FROM categories";
        $result = $this->conn->query($sql);
        $categories = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $categories[] = new Category($this->conn, $row['id'], $row['name']);
            }
        }
        
        return $categories;
    }
}
?>
