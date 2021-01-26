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
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "SELECT * FROM " . $this->table_name . " WHERE email = " . "'" . $email . "'" . " AND password = " . "'" .  $hashedPassword . "'";
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

        public function registerUser($name, $cogname, $password, $email, $data_nascita){
            $query = "
                INSERT INTO " . $this->table_name . " (nome, cognome, email, password, data_nascita)
                VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$name, $cogname, $email, $password, $data_nascita]);
        }

        public function checkEmail($email){
            $query = "
            SELECT id
            FROM " . $this->table_name . "
            WHERE email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$email]);
            $num = $stmt->rowCount();
            if($num == 0){
                return false;
            } else {
                return true;
            }
        }

    }

?>