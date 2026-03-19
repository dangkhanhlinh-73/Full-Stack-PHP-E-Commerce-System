<?php
class Product {
    private $id;
    private $id_category;
    private $image;
    private $name;
    private $price;
    private $quantity;
    private $status;
    private $conn;

    public function __construct($conn, $id = null, $id_category = null, $image = null, $name = null, $price = null, $quantity = null, $status = null) {
        $this->conn = $conn;
        $this->id = $id;
        $this->id_category = $id_category;
        $this->image = $image;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdCategory() {
        return $this->id_category;
    }

    public function getImage() {
        return $this->image;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function isStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdCategory($id_category) {
        $this->id_category = $id_category;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setStatus($status) {
        $this->status = $status;
    }



}
?>
