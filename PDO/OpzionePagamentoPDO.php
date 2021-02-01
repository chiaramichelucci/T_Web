<?php

    class OpzionePagamentoPDO{

        protected $conn;
        protected $table_name = "opzione_pagamento";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getOpzionePagamento(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }     

        public function getOPUser($user){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id_user = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user]);
            return $stmt;
        }

    }

?>