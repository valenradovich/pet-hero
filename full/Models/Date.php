<?php
    namespace Models;

    class Date {
        private $id_dateRange;
        private $start_date;
        private $end_date;
        private $id_user;
        private $status;

        public function getIdDate(){
            return $this->id_dateRange;
        }

        public function setIdDate($id_dateRange){
            $this->id_dateRange = $id_dateRange;
        }

        public function getStartDate(){
            return $this->start_date;
        }

        public function setStartDate($start_date){
            $this->start_date = $start_date;
        }

        public function getEndDate(){
            return $this->end_date;
        }

        public function setEndDate($end_date){
            $this->end_date = $end_date;
        }

        public function getIdUser(){
            return $this->id_user;
        }

        public function setIdUser($id_user){
            $this->id_user = $id_user;
        }

        public function getEstado(){
            return $this->status;
        }

        public function setEstado($status){
            $this->status = $status;
        }
    }

?>