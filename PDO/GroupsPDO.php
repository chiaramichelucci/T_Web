<?php

    class GroupsPDO{

        protected $conn;
        protected $table_name = "groups";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getGroups(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }

        public function checkGroup($userID){
            $sql = "SELECT * FROM users_has_groups WHERE id_user = " . "'" . $userID . "'";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            $gruppo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $gruppo;
        }

    }

?>