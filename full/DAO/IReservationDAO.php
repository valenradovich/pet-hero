<?php
    namespace DAO;

    use Models\Reservation as Reservation;

    interface IReservationDAO
    {
        function Add(Reservation $reservation);
        function GetAll();
        function Remove($id_reservation);
        function getById($id_reservation);
    }
?>