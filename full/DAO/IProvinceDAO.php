<?php
    namespace DAO;

    use Models\Province as Province;

    interface IProvinceDAO
    {
        function GetAll();
        function getById($id_province);
    }
?>