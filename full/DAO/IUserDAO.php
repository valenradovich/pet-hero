<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO
    {
        function Add(User $user);
        function GetAll();
        function Remove($id);
        function getByEmail($email);
    }
?>