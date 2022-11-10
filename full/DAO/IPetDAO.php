<?php
    namespace DAO;

    use Models\Pet as Pet;

    interface IPetDAO
    {
        function Add(Pet $pet);
        function GetAll();
        function Remove($id_pet);
        function getById($id_pet);
    }
?>