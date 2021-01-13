<?php require '../PDO/GroupHasServicesPDO.php' ?>
<?php

    class GroupHasServices extends GroupHasServicesPDO{

        public $service_username;
        public $group_id;

        public function __construct($service_username, $group_id) {
            $this->service_username = $service_username;
            $this->group_id = $group_id;
        }

        public function getServiceUsername(){
            return $this->$service_username;
        }

        public function getGroupId(){
            return $this->$group_id
        }

        public function setServiceUsername($service_username){
            $this->service_username = $service_username;
        }

        public function setGroupId($group_id){
            $this->group_id = $group_id;
        }
    }

?>