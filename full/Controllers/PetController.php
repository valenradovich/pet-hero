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

        
        public function save_image($file){

            $fileName = $file["name"];
            $tempFileName = $file["tmp_name"];
            $type = $file["type"];
            
            #   esta ruta funcionó, cambiar el resto con esta
            $filePath = ROOT."Imgs/".basename($fileName);          
            
            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $imageSize = getimagesize($tempFileName);

            if ($imageSize !== false) {
                if (move_uploaded_file($tempFileName, $filePath)) {
                    $fileData = [
                        'name' => $fileName,
                        'tmp_name' => $tempFileName,
                        'type' => $type,
                        'path' => $filePath,
                        'fileType' => $fileType,
                        'imageSize' => $imageSize
                    ];

                    return $fileData;
                } 
            } else {
                return false;
            }
        }

        public function Add($name_pet, $id_breed, $id_size, $vaccines, $photo, $video, $description) {
            try {
                $fileData = $this->save_image($photo);
                $fileData2 = $this->save_image($vaccines);
             
                $pet = new Pet();
                $pet->setName($name_pet);
                $pet->setBreed($id_breed);
                $pet->setSize($id_size);
                $pet->setPetType($_GET['id_pet_type']);
                $pet->setVaccines($fileData2['name']);
                $pet->setPhoto($fileData['name']);
                if($video['name'] != ""){
                    $fileData3 = $this->save_image($video);
                    $pet->setVideo($fileData3['name']);
                } else {
                    $pet->setVideo("");
                }
                $pet->setDescription($description);
                $pet->setIdOwner($_SESSION["loggedUser"]["id"]);

                $this->petDAO->Add($pet);

                $alert = [
                    "title" => "Success",
                    "text" => "Pet added successfully",
                    "icon" => "success"
                ];
                
                $this->ShowAddView($alert);
                    
                
                
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

                $alert = [
                    "title" => "Success",
                    "text" => "Pet removed successfully",
                    "icon" => "success"
                ];

                $this->ShowListView($alert);
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