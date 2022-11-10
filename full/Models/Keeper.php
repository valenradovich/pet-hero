<?php
    namespace Models;

    use DAO\KeeperDAO as KeeperDAO;

    class Keeper extends User {

        private $id_user;
        private $first_name;
        private $last_name;
        private $password;
        private $email;
        private $dni;
        private $id_province;
        private $id_city;
        private $phone;
        private $address;
        private $user_type = 2;
        private $photo;
        private $date_range;

        public function getId() {
            return $this->id_user;
        }

        public function setId($id_user) {
            $this->id_user = $id_user;
        }

        public function getFirstName() {
            return $this->first_name;
        }

        public function setFirstName($first_name) {
            $this->first_name = $first_name;
        }

        public function getLastName() {
            return $this->last_name;
        }

        public function setLastName($last_name) {
            $this->last_name = $last_name;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getDNI() {
            return $this->dni;
        }

        public function setDNI($dni) {
            $this->dni = $dni;
        }

        public function getProvince() {
            return $this->id_province;
        }

        public function setProvince($id_province) {
            $this->id_province = $id_province;
        }

        public function getCity() {
            return $this->id_city;
        }

        public function setCity($id_city) {
            $this->id_city = $id_city;
        }

        public function getLiveIn() {
            $this->keeperDAO = new KeeperDAO();
            $live_place = $this->keeperDAO->getLivePlace($this->id_province, $this->id_city);

            return $live_place;
        }

        public function getPhone() {
            return $this->phone;
        }

        public function setPhone($phone) {
            $this->phone = $phone;
        }

        public function getAddress() {
            return $this->address;
        }

        public function setAddress($address) {
            $this->address = $address;
        }

        public function getUserType() {
            return $this->user_type;
        }

        public function getUserTypeString() {
            if($this->user_type == 1)
                return "Owner";
            else
                return "Keeper";
        }


        public function setUserType($user_type) {
            $this->user_type = $user_type;
        }

        public function getPhoto() {
            return $this->photo;
        }

        public function setPhoto($photo) {
            $this->photo = $photo;
        }

        public function getFullName() {
            return $this->first_name . " " . $this->last_name;
        }

        public function getDateRange() {
            $this->keeperDAO = new KeeperDAO();
            $date_range = $this->keeperDAO->getDateRange($this->id_user);

            return $date_range;
        }

        public function setDateRange($date_range) {
            $this->date_range = $date_range;
        }
        
    }


?>