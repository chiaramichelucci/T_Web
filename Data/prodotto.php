<?php require '../PDO/prodottoPDO.php' ?>
<?php

    class Prodotto extends ProdottoPDO{

        public $id;
        public $prezzo;
        public $sconto;
        public $id_categoria;
        public $descrizione;
        public $id_produttore;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getPrezzo(){
            return $this->prezzo;
        }

        public function getSconto(){
            return $this->sconto;
        }

        public function getIdCategoria(){
            return $this->id_categoria;
        }

        public function getDescrizione(){
            return $this->descrizione;
        }

        public function getIdProduttore(){
            return $this->id_produttore;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setPrezzo($prezzo){
            $this->prezzo = $prezzo;
        }
        public function setSconto($sconto){
            $this->sconto = $sconto;
        }
        public function setIdCategoria($id_categoria){
            $this->id_categoria = $id_categoria;
        }
        public function setDescrizione($descrizione){
            $this->descrizione = $descrizione;
        }
        public function setIdProduttore($id_produttore){
            $this->id_produttore = $id_produttore;
        }

    }

?>