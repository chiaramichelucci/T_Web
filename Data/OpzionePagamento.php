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

        public function getID(){
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

        public function setID($id){
            $this->id = $id;
        }

        public function setNumeroCarta($numero_carta){
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

        public function getOpzione($id){
            $coso = parent::getOpzione($id);
            $opzione = $coso->fetch(PDO::FETCH_ASSOC);
            if($opzione == false){
                $this->setId(0);
            } else {
                $this->setID($opzione['id']);
                $this->setNumeroCarta($opzione['numero_carta']);
                $this->setScadenza($opzione['scadenza']);
                $this->setCvv($opzione['cvv']);
                $this->setNomeProprietario($opzione['nome_proprietario']);
            }
        }

        public function modificaOpzionoPagamento($id){
            $status = parent::modificaOpzionoPagamento($id);
            return $status;
        }

        public function cancellaOpzionePagamento($id){
            $status = parent::cancellaOpzionePagamento($id);
            return $status;
        }


    }

?>