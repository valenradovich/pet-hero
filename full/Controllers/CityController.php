<?php   
    namespace Controllers;

    use DAO\CityDAO as CityDAO;
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
            $cityList = $this->cityDAO->GetAll();
        }
    }

?>