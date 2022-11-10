<?php
    namespace DAO;

    use Models\Reservation as Reservation;

    interface IReservationDAO
    {
        function Add(Reservation $pet);
        function GetAll();
        function Remove($id_pet);
        function getById($id_pet);
    }
?>