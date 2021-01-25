<?php

    class UserPDO{

        protected $conn;
        protected $table_name = "user";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getUser(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }  

        public function checkUser($email, $password){
            $hashedPassword = hash('sha256', $password);
            $sql = "SELECT * FROM " . $this->table_name . " WHERE email = " . "'" . $email . "'" . " AND password = " . "'" .  $password . "'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $num = $stmt->rowCount();
            if($num == 0){
                return false;
            } else {
                $utente = $stmt->fetch(PDO::FETCH_ASSOC);
                return $utente;
            }
        }

    }

?>