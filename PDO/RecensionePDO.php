<?php

    class RecensionePDO{

        protected $conn;
        protected $table_name = "recensione";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getRecensione($prodottoId){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id_prodotto = ?";
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute([$prodottoId]);
            return $stmt;
        }

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }    

        public function addRecens($id_user, $id_prod, $titolo, $voto, $testo){
            $query = "
                INSERT INTO " . $this->table_name . " (id_user, id_prodotto, titolo, voto, testo)
                VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id_user, $id_prod, $titolo, $voto, $testo]);
        }
        

    }

?>