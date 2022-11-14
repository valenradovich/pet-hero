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

        public function show_add_view() {
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

                # alert

                $this->show_add_view();
            } catch (Exception $ex) {
                # alert
                echo '<p>error</p>';

                $this->show_add_view();
            }
        }

        public function remove($id_specification) {
            try {
                $this->specDAO->Remove($id_specification);

                # alert
                
                #$this->show_list_view();
                header("location: ".FRONT_ROOT."keeper/keeperprofile");
            } catch (Exception $ex) {
                # alert

                #$this->show_list_view();
                header("location: ".FRONT_ROOT."keeper/keeperprofile");
                
            }
        }
    }

?>