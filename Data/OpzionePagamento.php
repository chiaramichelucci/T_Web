<?php require '../PDO/OpzionePagamentoPDO.php' ?>
<?php

    class OpzionePagamento extends OpzionePagamentoPDO{

        public $id;
        public $numero_carta;
        public $scadenza;
        public $cvv;
        public $nome_proprietario;
        public $id_user;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getNumeroCarta(){
            return $this->numero_carta;
        }

        public function getScadenza(){
            return $this->scadenza;
        }
        public function getCvv(){
            return $this->cvv;
        }

        public function getNomeProprietario(){
            return $this->nome_proprietario;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNumeroProdotto($numero_carta){
            $this->numero_carta = $numero_carta;
        }

        public function setScadenza($scadenza){
            $this->scadenza = $scadenza;
        }
        public function setCvv($cvv){
            $this->cvv = $cvv;
        }

        public function setNomeProprietario($nome_proprietario){
            $this->nome_proprietario = $nome_proprietario;
        }

        public function setIdUser($id_user){
            $this->id_user = $id_user;
        }

        public function aggiungiOpzionePagamento(){
            $status = parent::aggiungiOpzionePagamento();
            return $status;
        }

    }

?>