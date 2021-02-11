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
        
        public function creaInfoPag($id_ordine){
            $sql = "INSERT INTO " . $this->table_name . " (id_ordine, modalita, numero_carta, nome_proprietario, scadenza, cvv)
            VALUES ( ?, ?, ?, ?, ?, ? )";
            $stmt = $this->conn->prepare( $sql );
            $stmt->bindParam(1, $id_ordine, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->modalita, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->numero_carta, PDO::PARAM_INT);
            $stmt->bindParam(4, $this->nome_proprietario, PDO::PARAM_STR);
            $stmt->bindParam(5, $this->scadenza, PDO::PARAM_STR);
            $stmt->bindParam(6, $this->cvv, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        }

    }

?>
