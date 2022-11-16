<?php
    namespace Controllers;

    use DAO\PetDAO as PetDAO;
    use Models\Pet as Pet;
    use DAO\BreedDAO as BreedDAO;

    use Exception;

    class PetController
    {
        private $petDAO;

        public function __construct()
        {
            $this->petDAO = new PetDAO();
            $this->BreedDAO = new BreedDAO();
        }

        public function ShowAddView($alert="")
        {
            $breedList = $this->BreedDAO->GetAll(); 
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-pet.php");
        }

        public function ShowListView($alert="")
        {
            $petList = $this->petDAO->getAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."pet-list.php");
        }

        public function Add($name_pet, $id_breed, $id_size, $id_pet_type, $vaccines, $photo, $video, $description) {
            try {
                $fileName = $photo["name"];
                $tempFileName = $photo["tmp_name"];
                $type = $photo["type"];

                $filePath = ROOT."Imgs/".$fileName; 
                         
                
                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
 
                $imageSize = getimagesize($tempFileName);
 
                if($imageSize !== false) {

                    if (move_uploaded_file($tempFileName, $filePath)) {
                        $pet = new Pet();
                        $pet->setName($name_pet);
                        $pet->setBreed($id_breed);
                        $pet->setSize($id_size);
                        $pet->setPetType($id_pet_type);
                        $pet->setVaccines($vaccines);
                        $pet->setPhoto($photo);
                        $pet->setVideo($video);
                        $pet->setDescription($description);
                        $pet->setIdOwner($_SESSION["loggedUser"]["id"]);

                        $this->petDAO->Add($pet);

                        $alert = [
                            "title" => "Success",
                            "text" => "Pet added successfully",
                            "icon" => "success"
                        ];
                        
                        $this->ShowAddView($alert);
                    }
                }
                
            } catch (Exception $ex) {
                
                $alert = [
                    "title" => "Error",
                    "text" => "Pet could not be added, try again",
                    "icon" => "error"
                ];
                $this->ShowAddView($alert);
            }
            
        }

        public function Remove($id_pet) {
            try {
                $this->petDAO->Remove($id_pet);

                $this->ShowListView();
            } catch (Exception $ex) {
                $alert = [
                    "title" => "Error",
                    "text" => "Pet could not be removed, try again",
                    "icon" => "error"
                ];
                $this->ShowListView($alert);
            }

        }
        
    }

?>