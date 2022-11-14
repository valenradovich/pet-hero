<?php
    namespace DAO;

    use DAO\IPetDAO as IPetDAO;
    use Models\Pet as Pet;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Exception;

    class PetDAO implements IPetDAO
    {
        private $connection;
        private $tableName = "pets";

        # manejar dentro de bloque try catch todo dentro del DAO
        public function Add(Pet $pet)
        {
            try {
                $query = "CALL pets_add(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
                $parameters["name_pet"] = $pet->getName();
                $parameters["photo"] = $pet->getPhoto();
                $parameters["id_breed"] = $pet->getBreed();
                $parameters["id_size"] = $pet->getSize();
                $parameters["id_pet_type"] = $pet->getPetType();
                $parameters["vaccines"] = $pet->getVaccines();
                $parameters["video"] = $pet->getVideo();
                $parameters["description"] = $pet->getDescription();
                $parameters["id_owner"] = $pet->getIdOwner(); 
                

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);  

            } catch (Exception $ex) {
                //throw $th;
            }

            
            
        }

        public function GetAll()
        {
            $petList = array();

            $query = "CALL pets_get_all()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach ($result as $row)
            {
                $pet = new Pet();
                $pet->setId($row["id_pet"]);
                $pet->setName($row["name_pet"]);
                $pet->setPhoto($row["photo"]);
                $pet->setBreed($row["id_breed"]);
                $pet->setSize($row["id_size"]);
                $pet->setPetType($row["id_pet_type"]);
                $pet->setVaccines($row["vaccines"]);
                $pet->setVideo($row["video"]);
                $pet->setDescription($row["description"]);
                $pet->setIdOwner($row["id_owner"]);

                array_push($petList, $pet);
            }

            return $petList;
        }

        public function Remove($id_pet) {
            try {
                $query = "CALL pet_remove(?)";

                $parameters["id_pet"] =  $id_pet;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);

            } catch (Exception $ex) {
                //throw $th;
            }  
        }

        public function getById($id_pet)
        {
            $pet = null;

            $query = "CALL pet_get_by_id(?)";

            $parameters["id_pet"] = $id_pet;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($result as $row) {

                $pet = new Pet();
                $pet->setId($row["id_pet"]);
                $pet->setName($row["name_pet"]);
                $pet->setPhoto($row["photo"]);
                $pet->setBreed($row["id_breed"]);
                $pet->setSize($row["id_size"]);
                $pet->setPetType($row["id_pet_type"]);
                $pet->setVaccines($row["vaccines"]);
                $pet->setVideo($row["video"]);
                $pet->setDescription($row["description"]);
                $pet->setIdOwner($row["id_owner"]);
            }

            return $pet;
        }

    }

?>