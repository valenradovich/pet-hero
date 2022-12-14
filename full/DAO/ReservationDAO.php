<?php
    namespace DAO;

    use DAO\IReservationDAO as IReservationDAO;
    use Models\Reservation as Reservation;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Exception;

    class ReservationDAO implements IReservationDAO {
        private $connection;
        private $tableName = "reservations";

        # manejar dentro de bloque try catch todo dentro del DAO
        public function add(Reservation $reservation)
        {
            try {
                $query = "CALL reservation_add(?, ?, ?, ?, ?, ?, ?, ?)";

                $parameters["id_owner"] = $reservation->getIdOwner();
                $parameters["id_pet"] = $reservation->getIdPet();
                $parameters["id_breed"] = $reservation->getIdBreed();
                $parameters["id_keeper"] = $reservation->getIdKeeper();
                $parameters["price"] = $reservation->getPrice();
                $parameters["id_date"] = $reservation->getIdDate();
                $parameters["start_date"] = $reservation->getStartDate();
                $parameters["end_date"] = $reservation->getEndDate();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure); 

            } catch (Exception $ex) {
                echo 'error';
            }     
        }

        public function GetAll()
        {
            $reservationList = array();

            $query = "CALL reservation_get_all()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach ($result as $row)
            {
                $reservation = new Reservation();
                $reservation->setIdReservation($row["id_reservation"]);
                $reservation->setIdOwner($row["id_owner"]);
                $reservation->setIdPet($row["id_pet"]);
                $reservation->setIdBreed($row["id_breed"]);
                $reservation->setIdKeeper($row["id_keeper"]);
                $reservation->setPrice($row["price"]);
                $reservation->setIdDate($row["id_date"]);
                $reservation->setStatus($row["status"]);
                $reservation->setOrderDate($row["order_date"]);
                $reservation->setStartDate($row["start_date"]);
                $reservation->setEndDate($row["end_date"]);

                array_push($reservationList, $reservation);
            }

            return $reservationList;
        }

        public function Remove($id_reservation)
        {
            $query = "CALL reservations_remove(?)";

            $parameters["id_reservation"] = $id_reservation;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        public function getById($id_reservation)
        {
            $reservation = null;
            
            $query = "CALL reservations_get_by_id(?)";

            $parameters["id_reservation"] = $id_reservation;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($result as $row) {
                $reservation = new Reservation();
                $reservation->setIdReservation($row["id_reservation"]);
                $reservation->setIdOwner($row["id_owner"]);
                $reservation->setIdPet($row["id_pet"]);
                $reservation->setIdBreed($row["id_breed"]);
                $reservation->setIdKeeper($row["id_keeper"]);
                $reservation->setPrice($row["price"]);
                $reservation->setIdDate($row["id_date"]);
                $reservation->setStatus($row["status"]);
                $reservation->setOrderDate($row["order_date"]);
                $reservation->setStartDate($row["start_date"]);
                $reservation->setEndDate($row["end_date"]);
            }

            return $reservation;

        }

        public function Update($id, $status) {
            try {
                $query = "CALL reservations_update(?, ?)";

                $parameters["id_reservation"] = $id;
                $parameters["status"] = $status;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
                
            } catch (Exception $ex) {
                //throw $th;
            }

            
        }

        public function validation($id_keeper, $id_date) {
            try {
                $reservationList = array();

                $query = "CALL reservations_by_idk_idDate_status(?, ?, ?)";

                $parameters["id_keeper"] = $id_keeper;
                $parameters["id_date"] = $id_date;
                $parameters["status"] = "accepted";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                foreach ($result as $row)
                {
                    $reservation = new Reservation();
                    $reservation->setIdReservation($row["id_reservation"]);
                    $reservation->setIdOwner($row["id_owner"]);
                    $reservation->setIdPet($row["id_pet"]);
                    $reservation->setIdBreed($row["id_breed"]);
                    $reservation->setIdKeeper($row["id_keeper"]);
                    $reservation->setPrice($row["price"]);
                    $reservation->setIdDate($row["id_date"]);
                    $reservation->setStatus($row["status"]);
                    $reservation->setOrderDate($row["order_date"]);
                    $reservation->setStartDate($row["start_date"]);
                    $reservation->setEndDate($row["end_date"]);
    
                    array_push($reservationList, $reservation);
                }
    
                return $reservationList;
                
            } catch (Exception $ex) {
                echo 'error en validation db reservation';
            }
        }
    }

?>