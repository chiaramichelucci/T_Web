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

    }

?>