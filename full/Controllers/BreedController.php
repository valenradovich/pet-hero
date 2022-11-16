<?php
    namespace Controllers;

    use DAO\BreedDAO as BreedDAO;
    use Models\Breed as Breed;

    class BreedController {

        private $breedDAO;

        public function __construct()
        {
            $this->breedDAO = new BreedDAO();
        }

        public function GetAll()
        {
            $breedList = $this->breedDAO->GetAll();
        }
    }

?>
