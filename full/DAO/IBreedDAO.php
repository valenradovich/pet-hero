<?php
    namespace DAO;

    use Models\Breed as Breed;

    interface IBreedDAO
    {
        function GetAll();
        function getById($id_breed);
    }
?>