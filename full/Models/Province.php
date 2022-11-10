<?php

    namespace Models;

    class Province {
        private $id_province;
        private $province_name;

        public function getId() {
            return $this->id_province;
        }

        public function setId($id_province) {
            $this->id_province = $id_province;
        }

        public function getName() {
            return $this->province_name;
        }

        public function setName($province_name) {
            $this->province_name = $province_name;
        }
    }

?>