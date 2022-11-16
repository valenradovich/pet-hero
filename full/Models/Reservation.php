<?php
    namespace Models;

    class Reservation {
        private $id_reservation;
        private $id_owner;
        private $id_pet;
        private $id_breed;
        private $id_keeper;
        private $price;
        private $id_date;
        private $status;
        private $order_date;
        private $start_date;
        private $end_date;

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

        public function getIdBreed() {
            return $this->id_breed;
        }

        public function setIdBreed($id_breed) {
            $this->id_breed = $id_breed;
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
            return $this->id_date;
        }

        public function setIdDate($id_date) {
            $this->id_date = $id_date;
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

        public function getStartDate() {
            return $this->start_date;
        }

        public function setStartDate($start_date) {
            $this->start_date = $start_date;
        }

        public function getEndDate() {
            return $this->end_date;
        }

        public function setEndDate($end_date) {
            $this->end_date = $end_date;
        }

        public function getDateRange() {
            return $this->start_date . ' to ' . $this->end_date;
        }

        public function getDays(){
            $start = new \DateTime($this->start_date);
            $end = new \DateTime($this->end_date);
            $interval = $start->diff($end);
            return $interval->days;
        }

        public function getTotalPayment() {
            return $this->price * $this->getDays();
        }
    }

?>