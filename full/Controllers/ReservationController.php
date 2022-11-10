<?php
    namespace Controllers;

    use DAO\ReservationDAO as ReservationDAO;
    use Models\Reservation as Reservation;
    use Exception;

    class ReservationController {
        private $reservationDAO;

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();
        }

        public function show_add_view() {
            require_once(VIEWS_PATH."validate-session.php");
            # crear add reservation
            require_once(VIEWS_PATH."add-reservation.php");
        }

        public function show_list_view() {
            $reservationList = $this->reservationDAO->GetAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."reservation-list.php");
        }

        # manejar las alerts como objetos
        public function add($id_pet, $id_keeper, $price, $id_date) {
            try {
                $reservation = new Reservation();
                $reservation->setIdOwner($_SESSION["loggedUser"]["id"]);
                $reservation->setIdPet($id_pet);
                $reservation->setIdKeeper($id_keeper);
                $reservation->setPrice($price);
                $reservation->setIdDate($id_date);

                $this->reservationDAO->Add($reservation);

                echo '<script type="text/javascript">',
                'swal("Listo", "Fecha registrada con éxito", "success");',
                '</script>';

                $this->show_add_view();

            } catch (Exception $ex) {
                echo '<script type="text/javascript">',
                'swal("Error", "No se pudo registrar la fecha", "error");',
                '</script>';

                $this->show_add_view();
            }
        }

        public function remove($id) {
            try {
                $this->reservationDAO->Remove($id);

                echo '<script type="text/javascript">',
                'swal("Listo", "Reserva eliminada con éxito", "success");',
                '</script>';

                $this->show_list_view();

            } catch (Exception $ex) {
                echo '<script type="text/javascript">',
                'swal("Error", "No se pudo eliminar la Reserva", "error");',
                '</script>';

                $this->show_list_view();
            }
        }


    }



?>