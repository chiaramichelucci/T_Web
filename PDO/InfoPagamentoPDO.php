<?php

    class InfoPagamentoPDO{

        protected $conn;
        protected $table_name = "info_pagamento";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getInfoPagamento(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }

    }

?>