<?php 

    class InfoSpedizionePDO{

        protected $conn;
        protected $table_name = "info_spedizione";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAll(){
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute();
            return $stmt;
        }
        
        public function creaInfoSped($id_ordine){
            $sql = "INSERT INTO " . $this->table_name . "(id_ordine, citta, via ,numero, cap, provincia, paese, altre_particolarita) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($id_ordine, $this->citta, $this->via, $this->numero, $this->cap, $this->provincia, $this->paese, $this->altre_particolarita));
            return $stmt;
        }
    }

?>
