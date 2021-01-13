<?php require '../PDO/UserHasGroupsPDO.php' ?>
<?php

    class UsersHasGroups extends UserHasGroupsPDO{

        public $users_id;
        public $groups_id;

        public function __construct($db) {
            parent::__construct($db);
        }

        public function getUsersId(){
            return $this->users_id;
        }

        public function getGroupsId(){
            return $this->groups_id;
        }

        public function setUsersId($users_id){
            $this->users_id = $users_id;
        }

        public function setGroupsId($groups_id){
            $this->groups_id = $groups_id;
        }

    }

?>