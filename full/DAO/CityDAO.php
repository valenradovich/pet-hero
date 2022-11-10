<?php
    namespace DAO;

    use DAO\ICityDAO as ICityDAO;
    use Models\City as City;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;

    class CityDAO implements ICityDAO {
        private $connection;
        private $tableName = "cities";
        public $cityList = array();

        public function GetAll()
        {
            $query = "CALL city_get_all()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $city = new City();
                $city->setId($row["id_city"]);
                $city->setName($row["city_name"]);
                $city->setId_province($row["id_province"]);

                array_push($this->cityList, $city);
            }
            return $this->cityList;
        }

        public function getById($id_city)
        {
            $query = "CALL city_get_by_id(?)";

            $parameters["id_city"] = $id_city;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $city = new City();
            $city->setId($result[0]["id_city"]);
            $city->setName($result[0]["name"]);
            $city->setId_province($result[0]["id_province"]);

            return $city;
        }
    }

?>