<?php
    namespace DAO;

    use DAO\IProvinceDAO as IProvinceDAO;
    use Models\Province as Province;
    
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;

    class ProvinceDAO implements IProvinceDAO
    {
        private $connection;
        private $tableName = "provinces";
        public $provinceList = array();

        public function GetAll()
        {
            $query = "CALL province_get_all()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $province = new Province();
                $province->setId($row["id_province"]);
                $province->setName($row["province_name"]);

                array_push($this->provinceList, $province);
            }
            return $this->provinceList;
        }

        public function getById($id_province)
        {
            $query = "CALL provinces_get_by_id(?)";

            $parameters["id_province"] = $id_province;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $province = new Province();
            $province->setId($result[0]["id_province"]);
            $province->setName($result[0]["name"]);

            return $province;
        }
    }
?>