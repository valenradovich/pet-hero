<?php
    namespace Controllers;

    use DAO\SpecDAO as SpecDAO;
    use Models\Spec as Spec;

    use Exception;

    class SpecController {
        private $specDAO;

        public function __construct() {
            $this->specDAO = new SpecDAO();
        }

        public function show_add_view($alert="") {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-specification.php");
        }

        public function show_list_view() {
            $specList = $this->specDAO->getAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."spec-list.php");
        }

        public function add($id_size_of_pets, $price_per_day) {
            try {
                $spec = new Spec();
                $spec->setIdKeeper($_SESSION["loggedUser"]["id"]);
                $spec->setIdSizeOfPets($id_size_of_pets);
                $spec->setPricePerDay($price_per_day);

                $this->specDAO->Add($spec);

                $alert = [
                    "title" => "Success",
                    "text" => "Specification successfully uploaded",
                    "icon" => "success"
                ];

                $this->show_add_view($alert);
            } catch (Exception $ex) {
                $alert = [
                    "title" => "Error",
                    "text" => "The specification could not be uploaded",
                    "icon" => "error"
                ];

                $this->show_add_view($alert);
            }
        }

        public function remove($id_specification) {
            try {
                $this->specDAO->Remove($id_specification);
                
                header("location: ".FRONT_ROOT."keeper/keeperprofile");
            } catch (Exception $ex) {
                # alert

                #$this->show_list_view();
                header("location: ".FRONT_ROOT."keeper/keeperprofile");
                
            }
        }
    }

?>