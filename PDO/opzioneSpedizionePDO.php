<?php 

    class OpzioneSpedizionePDO{

        protected $conn;
        protected $table_name = "opzione_spedizione";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }

        public function getOSUser($user){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id_user = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user]);
            return $stmt;
        }

        public function aggiungOpzionePagamento(){
            $sql = "INSERT INTO " . $this->table_name . "(citta, via ,numero, cap, provincia, paese, altre_particolarita, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($this->citta, $this->via, $this->numero, $this->cap, $this->provincia, $this->paese, $this->altre_particolarita, $this->id_utente));
            return $stmt;
        }

        public function getOpzione($id){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt;
        }

        public function modificaOpzioneSpedizione($id){
            $sql = "UPDATE " . $this->table_name . " SET citta='?', via='?', numero='?', cap='?', provincia='?', paese='?', altre_particolarita='?' WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($this->citta, $this->via, $this->numero, $this->cap, $this->provincia, $this->paese, $this->altre_particolarita, $this->id));
            return $stmt;
        }

        public function cancellaOpzioneSpedizione($id){
            $sql = "DELETE FROM " . $this->table_name . " WHERE id=? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt;
        }
    }

?>