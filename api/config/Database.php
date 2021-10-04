<?php
    class Database {
        //DB Params
        private $host = 'eu-cdbr-west-01.cleardb.com';
        private $db_name = 'heroku_6040d655babebd2';
        private $username = 'b7dc8d243d7a28';
        private $password = $_ENV['DBPASS'];
        private $conn;

        //DB Connect
        public function connect(){
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname='
                . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }

    ?>