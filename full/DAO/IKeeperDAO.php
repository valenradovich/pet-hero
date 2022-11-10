<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    interface IKeeperDAO
    {
        function Add(Keeper $keeper);
        function GetAll();
        function Remove($id);
        function getByEmail($email);
    }
?>