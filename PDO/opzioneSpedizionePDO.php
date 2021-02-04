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

        public function aggiungiOpzioneSpedizione(){
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
            $sql = "UPDATE " . $this->table_name . " SET citta=:citta, via=:via, numero=:numero, cap=:cap, provincia=:prov, paese=:paese, altre_particolarita=:al WHERE id=:id;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue( ":citta", $this->citta, PDO::PARAM_STR );
            $stmt->bindValue( ":via", $this->via, PDO::PARAM_STR );
            $stmt->bindValue( ":numero", $this->numero, PDO::PARAM_INT );
            $stmt->bindValue( ":cap", $this->cap, PDO::PARAM_INT );
            $stmt->bindValue( ":prov", $this->provincia, PDO::PARAM_STR );
            $stmt->bindValue( ":paese", $this->paese, PDO::PARAM_STR );
            $stmt->bindValue( ":al", $this->altre_particolarita, PDO::PARAM_STR );
            $stmt->bindValue( ":id", $this->id, PDO::PARAM_INT );
            
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
            
            //array($this->getCitta(), $this->getVia(), $this->getNumero(), $this->getCap(), $this->getProvincia(), $this->getPaese(), $this->getAltreParticolarita(), $this->getID())
        }

        public function cancellaOpzioneSpedizione($id){
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