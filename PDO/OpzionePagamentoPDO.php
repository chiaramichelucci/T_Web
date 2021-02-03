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

        public function aggiungOpzioneSpedizione(){
            $sql = "INSERT INTO " . $this->table_name . "(numero_carta, scadenza ,cvv, nome_proprietario, id_user) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($this->numero_carta, $this->scadenza, $this->cvv, $this->nome_proprietario, $this->id_utente));
            return $stmt;
        }

    }

?>