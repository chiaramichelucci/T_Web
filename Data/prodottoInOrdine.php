<?php require '../PDO/prodottoInOrdinePDO.php' ?>
<?php

    class ProdottoInOrdine extends ProdottoInOrdinePDO{

        public $id;
        public $id_ordine;
        public $id_prodotto;
        public $quantita;
        public $id_lotto;     
        

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getIdOrdine(){
            return $this->id_ordine;
        }
        
        public function getIdProdotto(){
            return $this->id_prodotto;
        }

        public function getQuantita(){
            return $this->quantita;
        }

        public function getIdLotto(){
            return $this->id_lotto;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdOrdine(){
            $this->id_ordine;
        }
        
        public function setIdProdotto(){
            $this->id_prodotto;
        }

        public function setQuantita(){
            $this->quantita;
        }

        public function setIdLotto(){
            $this->id_lotto;
        }

        public function getProdottoInOrdine($id){
            $pinor = parent::getId($id);
            if($pinor == false){
                $this->setId(0);
            } else {
                $this->setId($pinor['id']);
                $this->setIdpinorine($pinor['id_ordine']);
                $this->setIdProdotto($pinor['id_prodotto']);
                $this->setQuantita($pinor['quantita']);
                $this->setIdLotto($pinor['id_lotto']);

            }
        }
    }

?>