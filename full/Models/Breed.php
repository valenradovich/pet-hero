<?php

    namespace Models;

    class Breed {
        private $id_breed;
        private $name;
        private $pet_type;

        public function getId() {
            return $this->id_breed;
        }

        public function setId($id_breed) {
            $this->id_breed = $id_breed;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function getPetType() {
            return $this->pet_type;
        }

        public function setPetType($pet_type) {
            $this->pet_type = $pet_type;
        }

        
    }

?>