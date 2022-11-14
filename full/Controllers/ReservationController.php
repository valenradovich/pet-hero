<?php
    namespace Controllers;

    use DAO\ReservationDAO as ReservationDAO;
    use Models\Reservation as Reservation;

    use DAO\KeeperDAO as KeeperDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\DateDAO as DateDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\SpecDAO as SpecDAO;

    use Exception;

    class ReservationController {
        private $reservationDAO;

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();
            $this->keeperDAO = new KeeperDAO();
            $this->petDAO = new PetDAO();
            $this->dateDAO = new DateDAO();
            $this->ownerDAO = new OwnerDAO();
            $this->specDAO = new SpecDAO();
        }

        public function showAddView() {
            $keeperList = $this->keeperDAO->getAll();
            $petList = $this->petDAO->getAll();
            $dateList = $this->dateDAO->getAll();
            $specList = $this->specDAO->getAll();
            
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-reservation.php");
        }

        public function showListView() {
            $reservationList = $this->reservationDAO->GetAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."reservation-list.php");
        }

        # manejar las alerts como objetos
        public function add($id_pet, $id_keeper, $price, $id_date, $start_date, $end_date) {
            try {
                $reservation = new Reservation();
                $reservation->setIdOwner($_SESSION["loggedUser"]["id"]);
                $reservation->setIdPet($id_pet);
                $reservation->setIdKeeper($id_keeper);
                $reservation->setPrice($price);
                $reservation->setIdDate($id_date);
                $reservation->setStartDate($start_date);
                $reservation->setEndDate($end_date);
                $reservation->setStatus("awaiting response");


                $this->reservationDAO->add($reservation);

                #alert

                header("location:" . FRONT_ROOT . "owner/ownerprofile");

            } catch (Exception $ex) {
                echo 'error controller';

                header("location:" . FRONT_ROOT . "owner/ownerprofile");
            }
        }

        public function remove($id) {
            try {
                $this->reservationDAO->Remove($id);

                echo '<script type="text/javascript">',
                'swal("Listo", "Reserva eliminada con éxito", "success");',
                '</script>';

                $this->showListView();

            } catch (Exception $ex) {
                echo '<script type="text/javascript">',
                'swal("Error", "No se pudo eliminar la Reserva", "error");',
                '</script>';

                $this->showListView();
            }
        }


    }



?>