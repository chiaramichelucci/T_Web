<?php require '../PDO/UserPDO.php' ?>
<?php

    class User extends UserPDO{

        public $id;
        public $nome;
        public $cognome;
        public $email;
        public $password;
        public $data_nascita;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getId(){
            return $this->id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getCognome(){
            return $this->cognome;
        }
        public function getEmail(){
            return $this->email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getDataNascita(){
            return $this->data_nascita;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function setCognome($cognome){
            $this->cognome = $cognome;
        }
        public function setEmail($email){
            $this->email = $email;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function setDataNascita($data_nascita){
            $this->data_nascita = $data_nascita;
        }

        public function getUser($id){
            $coso = parent::getUser($id);
            if($coso == false){
                $this->setId(0);
            } else {
                $this->setId($coso['id']);
                $this->setNome($coso['nome']);
                $this->setCognome($coso['cognome']);
                $this->setEmail($coso['email']);
                $this->setDataNascita($coso['data_nascita']);
            }
        }

        public function checkUser($email, $password){
            $coso = parent::checkUser($email, $password);
            if($coso == false){
                $this->setId(0);
            } else {
                $this->setId($coso['id']);
                $this->setNome($coso['nome']);
                $this->setCognome($coso['cognome']);
                $this->setEmail($coso['email']);
                $this->setDataNascita($coso['data_nascita']);
            }
        }
    }

?>