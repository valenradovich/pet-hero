<?php
    namespace Controllers;

    use DAO\ProvinceDAO as ProvinceDAO;
    use Models\Province as Province;

    class ProvinceController {

        private $provinceDAO;

        public function __construct()
        {
            $this->provinceDAO = new ProvinceDAO();
        }

        public function GetAll()
        {
            $provinceList = $this->provinceDAO->GetAll();
        }
    }

?>
