<?php   
    namespace Controllers;

    use DAO\CityDAO as CityDAO;
use Exception;
use Models\City as City;

    class CityController
    {
        private $cityDAO;

        public function __construct()
        {
            $this->cityDAO = new CityDAO();
        }

        public function GetAll()
        {
            try {
                $cityList = $this->cityDAO->GetAll();
            } catch (Exception $th) {
                
            }
            
        }
    }

?>