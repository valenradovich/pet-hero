<?php
    namespace Controllers;

    use DAO\PetDAO as PetDAO;
    use Exception;
    use Models\Pet as Pet;

    class PetController
    {
        private $petDAO;

        public function __construct()
        {
            $this->petDAO = new PetDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-pet.php");
        }

        public function ShowListView()
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

                        echo '<script type="text/javascript">',
                        'swal("Listo", "Fecha registrada con éxito", "success");',
                        '</script>'
                        ;
                        
                        # poner header location
                        $this->ShowAddView();
                    }
                }
                
            } catch (Exception $ex) {
                
                echo '<script type="text/javascript">',
                'swal("Listo", "Fecha registrada con éxito", "success");',
                '</script>'
                ;
                $this->ShowAddView();
            }
            
        }

        public function Remove($id_pet) {
            $this->petDAO->Remove($id_pet);

            $this->ShowListView();
        }
        
    }

?>