<?php
    class Item {

        private $conn;
        private $table = 'products';
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
            // Sanitize inputs
            $this->SKU = htmlspecialchars(strip_tags($this->SKU));
            $this->Name = htmlspecialchars(strip_tags($this->Name));
            $this->Price = htmlspecialchars(strip_tags($this->Price));
            $this->Special_attribute = htmlspecialchars(strip_tags($this->Special_attribute));
        
            // Bind with sanitized inputs
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

        public function read() {
            //Create query
            $query = 'SELECT * FROM '.$this->table;

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        public function delete() {


            // Make SQL query
            $query = 'DELETE FROM '.$this->table.' WHERE id = :id'; 
            
            $stmt = $this->conn->prepare($query);
    
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            $stmt->bindParam(':id', $this->id);
    
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
    
        }
    }
?>