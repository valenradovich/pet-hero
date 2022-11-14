<?php
    namespace DAO;

    use DAO\ISpecDAO as ISpecDAO;
    use Models\Spec as Spec;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Exception;

    class SpecDAO implements ISpecDAO {

        private $connection;
        private $tableName = "specifications";

        public function Add(Spec $spec){
            try {
                $query = "CALL specifications_add(?, ?, ?)";
            
                $parameters["id_keeper"] = $spec->getIdKeeper();
                $parameters["id_size_of_pets"] = $spec->getIdSizeOfPets();
                $parameters["price_per_day"] = $spec->getPricePerDay();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);  

            } catch (Exception $ex) {
                echo '<p>error</p>';
            }
                
        }
        
        public function GetAll(){

            $specList = array();

            try {
                $query = "CALL specifications_get_all()";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

                foreach ($result as $row)
                {
                    $spec = new Spec();
                    $spec->setId($row["id_specification"]);
                    $spec->setIdKeeper($row["id_keeper"]);
                    $spec->setIdSizeOfPets($row["id_size_of_pets"]);
                    $spec->setPricePerDay($row["price_per_day"]);

                    array_push($specList, $spec);
                }

                return $specList;

            } catch (Exception $ex) {
                //throw $th;
            }
 
        }

        public function Remove($id_specification) {
            try {
                $query = "CALL specifications_remove(?)";
            
                $parameters["id_specification"] = $id_specification;
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);  

            } catch (Exception $ex) {
                //throw $th;
            }
        }

        public function getById($id_specification) {
            try {
                $query = "CALL specifications_get_by_id(?)";
            
                $parameters["id_specification"] = $id_specification;
                
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                $spec = new Spec();
                $spec->setId($result[0]["id_specification"]);
                $spec->setIdKeeper($result[0]["id_keeper"]);
                $spec->setIdSizeOfPets($result[0]["id_size_of_pets"]);
                $spec->setPricePerDay($result[0]["price_per_day"]);

                return $spec;

            } catch (Exception $ex) {
                //throw $th;
            }
        }
    }

?>