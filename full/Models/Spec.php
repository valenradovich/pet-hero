<?php
    namespace Models;

    class Spec {
        private $id_specification;
        private $id_keeper;
        private $small_pets;
        private $medium_pets;
        private $large_pets;
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

        public function getSmallPets() {
            return $this->small_pets;
        }

        public function setSmallPets($small_pets) {
            $this->small_pets = $small_pets;
        }

        public function getMediumPets() {
            return $this->medium_pets;
        }

        public function setMediumPets($medium_pets) {
            $this->medium_pets = $medium_pets;
        }

        public function getLargePets() {
            return $this->large_pets;
        }

        public function setLargePets($large_pets) {
            $this->large_pets = $large_pets;
        }    
        
        public function getStringSmallPets() {
            if ($this->small_pets == 1) {
                return "Small";
            }
        }

        public function getStringMediumPets() {
            if ($this->medium_pets == 1) {
                return "Medium";
            }
        }

        public function getStringLargePets() {
            if ($this->large_pets == 1) {
                return "Large";
            }
        }

        public function getAllStringPetsSize() {
            $pets = "";
            if ($this->small_pets == 1 && $this->medium_pets == 0 && $this->large_pets == 0) {
                return 'Small';
            }
            if ($this->medium_pets == 1 && $this->small_pets == 0 && $this->large_pets == 0) {
                return "Medium ";
            }
            if ($this->large_pets == 1 && $this->small_pets == 0 && $this->medium_pets == 0) {
                return "Large ";
            }
            if ($this->small_pets == 1 && $this->medium_pets == 1 && $this->large_pets == 1) {
                $pets = $pets . "Small, Medium and Large";
            }
            if ($this->small_pets == 1 && $this->medium_pets == 1 && $this->large_pets == 0) {
                $pets = $pets . "Small and Medium";
            }
            if ($this->small_pets == 1 && $this->medium_pets == 1 && $this->large_pets == 1) {
                $pets = $pets . "Small and Large ";
            }
            if ($this->small_pets == 0 && $this->medium_pets == 1 && $this->large_pets == 1) {
                $pets = $pets . "Medium and Large ";
            }
            return $pets;
        }

        public function getPricePerDay() {
            return $this->price_per_day;
        }

        public function setPricePerDay($price_per_day) {
            $this->price_per_day = $price_per_day;
        }  

    }

?>