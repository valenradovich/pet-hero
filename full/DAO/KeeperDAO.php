<?php
    namespace DAO;

    use DAO\IKeeperDAO as IKeeperDAO;
    use Models\Keeper as Keeper;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Exception;

    class KeeperDAO implements IKeeperDAO
    {
        private $connection;
        private $tableName = "users";

        public function Add(Keeper $keeper)
        {
            $query = "CALL users_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $parameters["first_name"] = $keeper->getFirstName();
            $parameters["last_name"] = $keeper->getLastName();
            $parameters["password"] = $keeper->getPassword();
            $parameters["dni"] = $keeper->getDni();
            $parameters["email"] = $keeper->getEmail();
            $parameters["phone"] = $keeper->getPhone();
            $parameters["photo"] = $keeper->getPhoto();
            $parameters["id_province"] = $keeper->getProvince();
            $parameters["id_city"] = $keeper->getCity();
            $parameters["id_user_type"] = $keeper->getUserType();
            $parameters["address"] = $keeper->getAddress();    
            

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);  
            
        }

        public function GetAll()
        {
            $keeperList = array();

            $query = "CALL users_get_all_keepers()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $keeper = new Keeper();
                $keeper->setId($row["id_user"]);
                $keeper->setFirstName($row["first_name"]);
                $keeper->setLastName($row["last_name"]);
                $keeper->setPassword($row["password"]);
                $keeper->setDNI($row["dni"]);   
                $keeper->setEmail($row["email"]);
                $keeper->setPhone($row["phone"]);
                $keeper->setPhoto($row["photo"]);
                $keeper->setProvince($row["id_province"]);
                $keeper->setCity($row["id_city"]);
                $keeper->setUserType($row["id_user_type"]);
                $keeper->setAddress($row["address"]);

                array_push($keeperList, $keeper);
            }

            return $keeperList;
        }

        public function Remove($id_user)
        {            
            $query = "CALL user_remove(?)";

            $parameters["id_user"] =  $id_user;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        public function getByEmail($email)
        {
            $keeper = null;

            $query = "CALL users_get_by_email(?)";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $keeper = new Keeper();
                $keeper->setId($row["id_user"]);
                $keeper->setFirstName($row["first_name"]);
                $keeper->setLastName($row["last_name"]);
                $keeper->setPassword($row["password"]);
                $keeper->setDNI($row["dni"]);   
                $keeper->setEmail($row["email"]);
                $keeper->setPhone($row["phone"]);
                $keeper->setPhoto($row["photo"]);
                $keeper->setProvince($row["id_province"]);
                $keeper->setCity($row["id_city"]);
                $keeper->setUserType($row["id_user_type"]);
                $keeper->setAddress($row["address"]);
            }

            return $keeper;
        }

        public function getLivePlace($id_province, $id_city) {
            $livePlace = null;

            $query = "CALL get_province_and_city_by_ids(?, ?)";

            $parameters["id_province"] = $id_province;
            $parameters["id_city"] = $id_city;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $livePlace = $row["province_name"] . ", " . $row["city_name"];
            }

            return $livePlace;
        }

        public function getDateRange($id) {
            try {
                $date = null;

                $query = "CALL dates_get_by_id_user(?)";

                $parameters["id_user"] = $id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                foreach($result as $row)
                {
                    $date = $row["start_date"] . " , " . $row["end_date"];
                }

                return $date;
                
            } catch (Exception $ex) {

                throw $ex;
            }
            
        }

        private function GetNextId()
        {
            $id_keeper = 0;

            foreach($this->keeperList as $keeper)
            {
                $id_keeper = ($keeper->getId() > $id_keeper) ? $keeper->getId() : $id_keeper;
            }

            return $id_keeper + 1;
        }

    }

?>