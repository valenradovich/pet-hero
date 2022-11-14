<?php
    namespace Models;

    class Spec {
        private $id_specification;
        private $id_keeper;
        private $id_size_of_pets;
        private $price_per_day;

        public function getId() {
            return $this->id_specification;
        }

        public function setId($id_specification) {
            $this->id_specification = $id_specification;
        }

        public function getIdKeeper() {
            return $this->id_keeper;
        }

        public function setIdKeeper($id_keeper) {
            $this->id_keeper = $id_keeper;
        }

        public function getIdSizeOfPets() {
            return $this->id_size_of_pets;
        }

        public function setIdSizeOfPets($id_size_of_pets) {
            $this->id_size_of_pets = $id_size_of_pets;
        }

        public function getPetSizeString() {
            if($this->id_size_of_pets == 1)
                return "Small";
            else if($this->id_size_of_pets == 2)
                return "Medium";
            else {
                return "Large";
            }
        }

        public function getPricePerDay() {
            return $this->price_per_day;
        }

        public function setPricePerDay($price_per_day) {
            $this->price_per_day = $price_per_day;
        }  

    }

?>