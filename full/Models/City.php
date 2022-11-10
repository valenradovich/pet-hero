<?php
    namespace Models;

    class City {
        private $id_city;
        private $city_name;
        private $id_province;

        public function getId() {
            return $this->id_city;
        }

        public function setId($id_city) {
            $this->id_city = $id_city;
        }

        public function getName() {
            return $this->city_name;
        }

        public function setName($city_name) {
            $this->city_name = $city_name;
        }

        public function getId_province() {
            return $this->id_province;
        }

        public function setId_province($id_province) {
            $this->id_province = $id_province;
        }
    }

?>