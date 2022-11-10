<?php
    namespace Models;

    class Reservation {
        private $id_reservation;
        private $id_owner;
        private $id_pet;
        private $id_keeper;
        private $price;
        private $id_date_range;
        private $status;
        private $order_date;

        public function getIdReservation() {
            return $this->id_reservation;
        }

        public function setIdReservation($id_reservation) {
            $this->id_reservation = $id_reservation;
        }

        public function getIdOwner() {
            return $this->id_owner;
        }

        public function setIdOwner($id_owner) {
            $this->id_owner = $id_owner;
        }

        public function getIdPet() {
            return $this->id_pet;
        }

        public function setIdPet($id_pet) {
            $this->id_pet = $id_pet;
        }

        public function getIdKeeper() {
            return $this->id_keeper;
        }

        public function setIdKeeper($id_keeper) {
            $this->id_keeper = $id_keeper;
        }

        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;
        }

        public function getIdDate() {
            return $this->id_date_range;
        }

        public function setIdDate($id_date_range) {
            $this->id_date_range = $id_date_range;
        }

        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function getOrderDate() {
            return $this->order_date;
        }

        public function setOrderDate($order_date) {
            $this->order_date = $order_date;
        }



    }

?>