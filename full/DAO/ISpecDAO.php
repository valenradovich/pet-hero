<?php
    namespace DAO;

    use Models\Spec as Spec;

    interface ISpecDAO {
        function Add(Spec $spec);
        function GetAll();
        function Remove($id_specification);
        function getById($id_specification);
    }

?>