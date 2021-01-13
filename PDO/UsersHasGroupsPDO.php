<?php

    class UsersHasGroupsPDO{

        protected $conn;
        protected $table_name = "users_has_groups";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getUsersHasGroups(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }
    }

?>