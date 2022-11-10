<?php
    namespace DAO;

    use DAO\IOwnerDAO as IOwnerDAO;
    use Models\Owner as Owner;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;

    class OwnerDAO implements IOwnerDAO
    {
        private $connection;
        private $tableName = "users";

        public function Add(Owner $owner)
        {
            $query = "CALL users_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $parameters["first_name"] = $owner->getFirstName();
            $parameters["last_name"] = $owner->getLastName();
            $parameters["password"] = $owner->getPassword();
            $parameters["dni"] = $owner->getDni();
            $parameters["email"] = $owner->getEmail();
            $parameters["phone"] = $owner->getPhone();
            $parameters["photo"] = $owner->getPhoto();
            $parameters["id_province"] = $owner->getProvince();
            $parameters["id_city"] = $owner->getCity();
            $parameters["id_user_type"] = $owner->getUserType();
            $parameters["address"] = $owner->getAddress();    
            

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);  

        }

        public function GetAll()
        {
            $ownerList = array();

            $query = "CALL users_get_all_owners()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $owner = new Owner();
                $owner->setId($row["id_owner"]);
                $owner->setFirstName($row["first_name"]);
                $owner->setLastName($row["last_name"]);
                $owner->setPassword($row["password"]);
                $owner->setDNI($row["dni"]);   
                $owner->setEmail($row["email"]);
                $owner->setPhone($row["phone"]);
                $owner->setPhoto($row["photo"]);
                $owner->setProvince($row["id_province"]);
                $owner->setCity($row["id_city"]);
                $owner->setUserType($row["id_user_type"]);
                $owner->setAddress($row["address"]);

                array_push($ownerList, $owner);
            }

            return $ownerList;
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
            $owner = null;

            $query = "CALL users_get_by_email(?)";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $owner = new Owner();
                $owner->setId($row["id_user"]);
                $owner->setFirstName($row["first_name"]);
                $owner->setLastName($row["last_name"]);
                $owner->setPassword($row["password"]);
                $owner->setDNI($row["dni"]);   
                $owner->setEmail($row["email"]);
                $owner->setPhone($row["phone"]);
                $owner->setPhoto($row["photo"]);
                $owner->setProvince($row["id_province"]);
                $owner->setCity($row["id_city"]);
                $owner->setUserType($row["id_user_type"]);
                $owner->setAddress($row["address"]);
                
            }

            return $owner;
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
            $date = null;

            $query = "CALL dates_get_by_id_user(?)";

            $parameters["id_user"] = $id;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $date = $row["date_range"];
            }

            return $date;
        }

        private function GetNextId()
        {
            $id_owner = 0;

            foreach($this->ownerList as $owner)
            {
                $id_owner = ($owner->getId() > $id_owner) ? $owner->getId() : $id_owner;
            }

            return $id_owner + 1;
        }
    }

?>