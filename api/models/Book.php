<?php
class Book extends Item {
    private $conn;
    private $table = 'products';

    //Properties
    private $id;
    private $SKU;
    private $Name;
    private $Price;
    private $Special_attribute;


    //Constructor with DB 
    public function __construct($db) {
        $this->conn = $db;
    }

    public function setid($id){
        $this->id = $id;
    }

    public function getid(){
        return $this->id;
    }
    public function setSKU($SKU){
        $this->SKU = $SKU;
    }

    public function getSKU(){
        return $this->SKU;
    }

    public function setName($Name){
        $this->Name = $Name;
    }

    public function getName(){
        return $this->Name;
    }
    public function setPrice($Price){
        $this->Price = $Price;
    }

    public function getPrice(){
        return $this->Price;
    }
    public function setSpecialAttribute($Special_attribute){
        $this->Special_attribute = $Special_attribute;
    }

    public function getSpecialAttribute(){
        return $this->Special_attribute;
    }

public function create() {
    $query = 'INSERT INTO '.$this->table.' SET 
        SKU = :SKU,
        Name = :Name,
        Price = :Price,
        Special_attribute = :Special_attribute';

    $stmt = $this->conn->prepare($query);
    $this->SKU =htmlspecialchars(strip_tags($this->SKU));
    $this->Name =htmlspecialchars(strip_tags($this->Name));
    $this->Price =htmlspecialchars(strip_tags($this->Price));
    $this->Special_attribute =htmlspecialchars(strip_tags($this->Special_attribute));

    $stmt->bindParam(':SKU', $this->SKU);
    $stmt->bindParam(':Name', $this->Name);
    $stmt->bindParam(':Price', $this->Price);
    $stmt->bindParam(':Special_attribute', $this->Special_attribute);

    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
}