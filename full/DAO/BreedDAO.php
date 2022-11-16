<?php
    namespace DAO;

    use DAO\IBreedDAO as IBreedDAO;
    use Models\Breed as Breed;
    
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;

    class BreedDAO implements IBreedDAO
    {
        private $connection;
        private $tableName = "breeds";
        public $breedList = array();

        public function GetAll()
        {
            $query = "CALL breeds_get_all()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $breed = new Breed();
                $breed->setId($row["id_breed"]);
                $breed->setName($row["name_breed"]);
                $breed->setPetType($row["pet_type"]);

                array_push($this->breedList, $breed);
            }
            return $this->breedList;
        }

        public function getById($id)
        {
            $query = "CALL breeds_get_by_id(?)";

            $parameters["id_breed"] = $id;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $breed = new Breed();
            $breed->setId($result["id_breed"]);
            $breed->setName($result["name_breed"]);
            $breed->setPetType($result["pet_type"]);

            return $breed;
        }
    }
?>