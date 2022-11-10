<?php
    namespace DAO;

    use Models\Date as Date;

    interface IDateDAO {
        function Add(Date $date);
        function GetAll();
        function Remove($id_date);
        function getById($id_date);
    }
?>