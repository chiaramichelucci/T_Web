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

        public function aggiungiOpzionePagamento(){
            $sql = "INSERT INTO " . $this->table_name . "(tipologia, numero_carta, scadenza ,cvv, nome_proprietario, id_user) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute(array($this->tipologia, $this->numero_carta, $this->scadenza, $this->cvv, $this->nome_proprietario, $this->id_user))){
                return true;
            }else{
                return false;
            }
        }

        public function getOpzione($id){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt;
        }

        public function modificaOpzionePagamento($id){
            $sql = "UPDATE " . $this->table_name . " SET numero_carta=:numero, cvv=:cvv, scadenza=:scadenza, nome_proprietario=:nome WHERE id=:id;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue( ":numero", $this->numero_carta, PDO::PARAM_INT );
            $stmt->bindValue( ":cvv", $this->cvv, PDO::PARAM_INT );
            $stmt->bindValue( ":scadenza", $this->scadenza, PDO::PARAM_STR );
            $stmt->bindValue( ":nome", $this->nome_proprietario, PDO::PARAM_STR );
            $stmt->bindValue( ":id", $this->id, PDO::PARAM_INT );
            
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
            
            //array($this->getCitta(), $this->getVia(), $this->getNumero(), $this->getCap(), $this->getProvincia(), $this->getPaese(), $this->getAltreParticolarita(), $this->getID())
        }

        public function cancellaOpzionePagamento($id){
            $sql = "DELETE FROM " . $this->table_name . " WHERE id=? ";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute([$id])){
                return true;
            }else{
                return false;
            }
        }

    }

?>
