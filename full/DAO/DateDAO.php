<?php
    namespace DAO;

    use DAO\IDateDAO as IDateDAO;
    use Models\Date as Date;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;

    class DateDAO implements IDateDAO 
    {
        private $connection;
        private $tableName = "datesRange";
        public $dateList = array();

        public function Add(Date $date)
        {
            $query = "CALL dates_add(?, ?, ?, ?)";

            $parameters["start_date"] = $date->getStartDate();
            $parameters["end_date"] = $date->getEndDate();
            $parameters["id_user"] = $date->getIdUser();
            $parameters["status"] = $date->getEstado();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);    
        }

        public function GetAll() {

            $query = "CALL dates_get_all()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach ($result as $row)
            {
                $date = new Date();
                $date->setIdDate($row["id_dateRange"]);
                $date->setStartDate($row["start_date"]);
                $date->setEndDate($row["end_date"]);
                $date->setIdUser($row["id_user"]);
                $date->setEstado($row["status"]);

                array_push($this->dateList, $date);
            }

            return $this->dateList;
            
        }
        

        public function Remove($id_date)
        {            
            # crear funcion sql
            $query = "CALL dates_remove(?)";

            $parameters["id_dateRange"] = $id_date;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        public function getById($id_date) {
            # crear funcion sql
            $query = "CALL dates_get_by_id(?)";

            $parameters["id_dateRange"] = $id_date;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach ($result as $row)
            {
                $date = new Date();
                $date->setIdDate($row["id_daterange"]);
                $date->setStartDate($row["start_date"]);
                $date->setEndDate($row["end_date"]);
                $date->setIdUser($row["id_user"]);
                $date->setEstado($row["status"]);
            }

            return $date;
            
        }

        public function getByUserId($id_user) {

            $query = "CALL dates_get_by_user_id(?)";

            $parameters["id_user"] = $id_user;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach ($result as $row)
            {
                $date = new Date();
                $date->setIdDate($row["id_daterange"]);
                $date->setStartDate($row["start_date"]);
                $date->setEndDate($row["end_date"]);
                $date->setIdUser($row["id_user"]);
                $date->setEstado($row["status"]);
            }
            
            return $date;
        }

        public function filter_by_dates($start_date, $end_date) {
            
            $dateListBetween = array();

            $query = "CALL dates_get_keepers_between_dates(?, ?)";

            $parameters["start_date"] = $start_date;
            $parameters["end_date"] = $end_date;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach ($result as $row)
            {
                $date = new Date();
                $date->setIdDate($row["id_daterange"]);
                $date->setStartDate($row["start_date"]);
                $date->setEndDate($row["end_date"]);
                $date->setIdUser($row["id_user"]);
                $date->setEstado($row["status"]);
                
                array_push($dateListBetween, $date);
            }

            return $dateListBetween;
        }

        private function GetNextId () {
            $id_date = 0;

            foreach ($this->dateList as $date) {
                $id_date = ($date->getIdDate() > $id_date) ? $date->getIdDate() : $id_date;
            }

            return $id_date + 1;
        }

    }

?>