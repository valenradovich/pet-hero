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
            $reservationList = $this->reservationDAO->getAll();
            
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
                # traigo el id_breed del pet que se cargó para la reserva
                $pet = $this->petDAO->getById($id_pet);
                $id_breed = $pet->getBreed();

                # triago una lista de las reservas creadas que coincidan keeper y fecha
                $validateList = $this->reservationDAO->validation($id_keeper, $id_date);

                # si la lista tiene registros entro al if
                if (count($validateList) >= 1) {

                    foreach($validateList as $reservation) {
                        if ($reservation->getIdBreed() != $id_breed) {
                            echo 'el keeper tiene una reserva esa misma fecha con otra raza de mascota';

                            header("location: ".FRONT_ROOT."owner/ownerprofile");
                        } else {
                            try {
                                $reservation = new Reservation();
                                $reservation->setIdOwner($_SESSION["loggedUser"]["id"]);
                                $reservation->setIdPet($id_pet);
                                $reservation->setIdBreed($id_breed);
                                $reservation->setIdKeeper($id_keeper);
                                $reservation->setPrice($price);
                                $reservation->setIdDate($id_date);
                                $reservation->setStartDate($start_date);
                                $reservation->setEndDate($end_date);
        
                                $this->reservationDAO->add($reservation);
        
                                echo 'reserva cargada desp de verificar, HAY reservas coincidentes';
        
                                header("location:" . FRONT_ROOT . "owner/ownerprofile");
                            } catch (Exception $ex) {
                                //throw $th;
                                header("location:" . FRONT_ROOT . "owner/ownerprofile");
                            }

                            
                        }
                    }

                } else {
                    try {
                        $reservation = new Reservation();
                        $reservation->setIdOwner($_SESSION["loggedUser"]["id"]);
                        $reservation->setIdPet($id_pet);
                        $reservation->setIdBreed($id_breed);
                        $reservation->setIdKeeper($id_keeper);
                        $reservation->setPrice($price);
                        $reservation->setIdDate($id_date);
                        $reservation->setStartDate($start_date);
                        $reservation->setEndDate($end_date);

                        $this->reservationDAO->add($reservation);

                        echo '<script type="text/javascript">',
                        'swal("Listo", "Reserva cargada con éxito", "success");',
                        '</script>'
                        ;

                        header("location:" . FRONT_ROOT . "owner/ownerprofile");
                    } catch (Exception $ex) {
                        //throw $th;
                        header("location:" . FRONT_ROOT . "owner/ownerprofile");
                    }
                }

            } catch (Exception $ex) {
                //throw $th;
            }

            
            /*foreach ($reservationList as $reservation) {
                if ($reservation->getIdKeeper() == $id_keeper && 
                    $reservation->getIdDate() == $id_date &&
                    $reservation->getStatus() == "accepted") {
                    foreach ($petList as $pet) {
                        if ($pet->getId()==$reservation->getIdPet()) {
                            foreach ($petList as $newPet){
                                if($newPet->getId()==$id_pet){
                                    if($pet->getBreed() == $newPet->getBreed()) {
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

                                            echo 'reserva cargada desp de verificar';

                                            header("location:" . FRONT_ROOT . "owner/ownerprofile");
                                        } catch (Exception $ex) {
                                            echo 'error';
                                            header("location:" . FRONT_ROOT . "owner/ownerprofile");
                                        }   

                                    } else {
                                        echo 'No se puede reservar a un cuidador con mascotas de distinta raza';
                                        header("location:" . FRONT_ROOT . "owner/ownerprofile");
                                    }

                                }

                            }
                            
                        }
                    }
                }
            }*/
        }

        public function remove($id) {
            try {
                $this->reservationDAO->Remove($id);

                # alert

                $this->showListView();

            } catch (Exception $ex) {
                # alert
                $this->showListView();
            }
        }

        public function update($id, $status) {
            try {
                $this->reservationDAO->Update($id, $status);

                # alert

                header("location:" . FRONT_ROOT . "keeper/keeperprofile");

            } catch (Exception $ex) {
                # alert

                header("location:" . FRONT_ROOT . "keeper/keeperprofile");
            }
        }


    }



?>