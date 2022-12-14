<?php
    namespace DAO;

    use Models\Owner as Owner;

    interface IOwnerDAO
    {
        function Add(Owner $owner);
        function GetAll();
        function Remove($id);
        function getByEmail($email);
    }
?>