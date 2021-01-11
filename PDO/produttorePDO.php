<?php

    class ProduttorePDO extends Produttore{

        public $conn;

        function __construct(\PDO $pdo){
            $this->conn = $pdo;
        }

        //da aggiungere qua tutte le funzioni mysql per l'oggetto produttore

        function getProduttori() {
            return $this->conn->query("SELECT * FROM produttore")->fetchAll();
        } 

        function getProduttore($id){
            return $this->conn->query("SELECT * FROM produttore WHERE id \= ". $this->$id)->fetchAll();
        }

        function deleteProduttore(){
            return $this->conn->exec("DELETE FROM produttore WHERE id \= ". $this->$id)->fetchAll();
        }

        function modProduttore(){
            return $this->conn->exec("UPDATE produttore SET ragione_sociale = ". $this->ragione_sociale.", 
                                                            partita_iva = ". $this->partita_iva.",
                                                            preffiso = ". $this->prefisso.", 
                                                            numero_verde = ". $this->numero_verde.", 
                                                            email = ". $this->email.", 
                                                            sito = ". $this->sito."  
                                                            WHERE id = ". $this->$id "\;")->fetchAll();
        }


    }

?>