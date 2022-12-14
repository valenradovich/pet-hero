<?php
    namespace Models;

    class Pet {
        private $id_pet;
        private $name_pet;
        private $photo;
        private $id_breed;
        private $id_size;
        private $id_pet_type;
        private $vaccines;
        private $video;
        private $description;
        private $id_owner;

        public function getId() {
            return $this->id_pet;
        }

        public function setId($id_pet) {
            $this->id_pet = $id_pet;
        }

        public function getName() {
            return $this->name_pet;
        }

        public function setName($name_pet) {
            $this->name_pet = $name_pet;
        }

        public function getBreed() {
            return $this->id_breed;
        }

        public function setBreed($id_breed) {
            $this->id_breed = $id_breed;
        }

        public function getBreedString() {
            switch ($this->id_breed) {
                case 1:
                    return "Street Dog";
                    break;
                case 2:
                    return "Bulldog Francés";
                    break;
                case 3:
                    return "Pastor alemán";
                    break;
                case 4:
                    return "Bulldog inglés";
                    break;
                case 5:
                    return "Jack russell terrier";
                    break;
                case 6:
                    return "Bóxer";
                    break;
                case 7:
                    return "Labrador";
                    break;
                case 8:
                    return "Caniche";
                    break;
                case 9:
                    return "Golden";
                    break;
                case 10:
                    return "Sharpei";
                    break;
                case 11:
                    return "Beagle";
                    break;
                case 12:
                    return "Salchicha";
                    break;
                case 13:
                    return "Rottweiler";
                    break;
                case 14:
                    return "San Bernardo";
                    break;
                case 15:
                    return "Chihuahua";
                    break;
                case 16:
                    return "Dálmata";
                    break;
                case 18:
                    return "Street Cat";
                    break;
                case 19:
                    return "Siamés";
                    break;
                case 20:
                    return "Sphynx";
                    break;
                case 21:
                    return "Van turco";
                    break;
                case 22:
                    return "Británico";
                    break;
                case 23:
                    return "Bengala";
                    break;
                case 23:
                    return "Persa";
                    break;
            }
        }

        public function getSize() {
            return $this->id_size;
        }

        public function getSizeString() {
            switch ($this->id_size) {
                case 1:
                    return "Small";
                    break;
                case 2:
                    return "Medium";
                    break;
                case 3:
                    return "Large";
                    break;
            }
        }

        public function setSize($id_size) {
            $this->id_size = $id_size;
        }

        public function getVaccines() {
            return $this->vaccines;
        }

        public function setVaccines($vaccines) {
            $this->vaccines = $vaccines;
        }

        public function getVideo() {
            return $this->video;
        }

        public function setVideo($video) {
            $this->video = $video;
        }

        public function getDescription() {
            return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function getIdOwner() {
            return $this->id_owner;
        }

        public function setIdOwner($id_owner) {
            $this->id_owner = $id_owner;
        }

        public function getPhoto() {
            return $this->photo;
        }

        public function setPhoto($photo) {
            $this->photo = $photo;
        }

        public function getPetType() {
            return $this->id_pet_type;
        }

        public function setPetType($id_pet_type) {
            $this->id_pet_type = $id_pet_type;
        }

        public function getPetTypeString() {
            $string = "";

            if ($this->id_pet_type == 1) {
                return "&#128054;";
            } else if ($this->id_pet_type == 2) {
                return "&#128049;";
            }
         }
    }



?>