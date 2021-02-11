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
            $sql = "SELECT groups_id FROM users_has_groups WHERE users_id = " . "'" . $userID . "'";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            $gruppo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $gruppo;
        }

        public function getGroup($userID){
            $sql = "SELECT * FROM users_has_groups WHERE users_id = " . "'" . $userID . "'";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            $gruppo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $gruppo;
        }

        public function promoteUser($uid, $gid){
            $sql = "UPDATE users_has_groups SET groups_id=:gid WHERE users_id = :uid";
            $stmt = $this->conn->prepare( $sql );
            $stmt->bindValue(":gid", $gid, PDO::PARAM_INT);
            $stmt->bindValue(":uid", $uid, PDO::PARAM_INT);
            if($stmt->execute()){
               return true; 
            } else {
                return false;
            }

        }

    }

?>