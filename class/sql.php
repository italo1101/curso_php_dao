<?php
    class Sql extends PDO{
        private $conn;

        public function __construct(){
            $this->conn = new PDO("mysql:host=localhost;dbname=db_php", "root", "");
        }

        private function setParams($stmt, $parameters = array()){
            foreach($parameters as $key => $value){
                $this->setParam($stmt, $key, $value);
            }
        }

        private function setParam($statment, $key, $value){
            $statment->bindParam($key, $value);
        }

        public function executeQuery($rawQuery, $params = array()){
            $stmt = $this->conn->prepare($rawQuery);
            $this->setParams($stmt, $params);
            $stmt->execute();
            return $stmt;
        }

        public function select($rawQuery, $params = array()):array{
            $stmt = $this->executeQuery($rawQuery, $params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }
    }
?>