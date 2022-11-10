<?php
    namespace DAO;

    use Models\City as City;

    interface ICityDAO
    {
        function GetAll();
        function getById($id_city);
    }
?>