<?php
    namespace DAO;

    use DAO\IReservationDAO as IReservationDAO;
    use Models\Reservation as Reservation;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;

    class ReservationDAO implements IReservationDAO {
        private $connection;
        private $tableName = "reservations";

        # falta crear todas las procedure en la base de datos

        # manejar dentro de bloque try catch todo dentro del DAO
        public function Create(Reservation $reservation)
        {
            $query = "CALL reservation_create(?, ?, ?, ?, ?, ?)";
            
            $parameters["id_owner"] = $reservation->getIdOwner();
            $parameters["id_pet"] = $reservation->getIdPet();
            $parameters["id_keeper"] = $reservation->getIdKeeper();
            $parameters["price"] = $reservation->getPrice();
            $parameters["id_date_range"] = $reservation->getIdDate();
            $parameters["status"] = $reservation->getStatus();
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);  
            
        }

        public function GetAll()
        {
            $reservationList = array();

            $query = "CALL reservations_get_all()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach ($result as $row)
            {
                $reservation = new Reservation();
                $reservation->setIdReservation($row["id_reservation"]);
                $reservation->setIdOwner($row["id_owner"]);
                $reservation->setIdPet($row["id_pet"]);
                $reservation->setIdKeeper($row["id_keeper"]);
                $reservation->setPrice($row["price"]);
                $reservation->setIdDate($row["id_date_range"]);
                $reservation->setStatus($row["status"]);
                $reservation->setOrderDate($row["order_date"]);

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
            $query = "CALL reservations_get_by_id(?)";

            $parameters["id_reservation"] = $id_reservation;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($result as $row) {
                $reservation = new Reservation();
                $reservation->setIdReservation($row["id_reservation"]);
                $reservation->setIdOwner($row["id_owner"]);
                $reservation->setIdPet($row["id_pet"]);
                $reservation->setIdKeeper($row["id_keeper"]);
                $reservation->setPrice($row["price"]);
                $reservation->setIdDate($row["id_date_range"]);
                $reservation->setStatus($row["status"]);
                $reservation->setOrderDate($row["order_date"]);
            }

            return $reservation;

        }
    }

?>