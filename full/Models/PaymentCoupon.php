<?php
    namespace Models;

    class PaymentCoupon{
        private $id_payment_coupon;
        private $id_reservation;
        private $id_owner;
        private $id_keeper;
        private $status;
        private $issue_date;
        private $amount;
        private $pay_date;

        public function getId(){
            return $this->id_payment_coupon;
        }

        public function setId($id_payment_coupon){
            $this->id_payment_coupon = $id_payment_coupon;
        }

        public function getIdReservation(){
            return $this->id_reservation;
        }

        public function setIdReservation($id_reservation){
            $this->id_reservation = $id_reservation;
        }

        public function getIdOwner(){
            return $this->id_owner;
        }

        public function setIdOwner($id_owner){
            $this->id_owner = $id_owner;
        }

        public function getIdKeeper(){
            return $this->id_keeper;
        }

        public function setIdKeeper($id_keeper){
            $this->id_keeper = $id_keeper;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getIssueDate(){
            return $this->issue_date;
        }

        public function setIssueDate($issue_date){
            $this->issue_date = $issue_date;
        }

        public function getAmount(){
            return $this->amount;
        }

        public function setAmount($amount){
            $this->amount = $amount;
        }

        public function getPayDate(){
            return $this->pay_date;
        }

        public function setPayDate($pay_date){
            $this->pay_date = $pay_date;
        }


    }

?>