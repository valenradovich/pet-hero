<?php
    namespace Models;

    abstract class User {

        abstract public function getId();
        abstract public function setId($id);
        abstract public function getFirstName();
        abstract public function setFirstName($first_name);
        abstract public function getLastName();
        abstract public function setLastName($last_name);
        abstract public function getPassword();
        abstract public function setPassword($password);
        abstract public function getEmail();
        abstract public function setEmail($email);
        abstract public function getDNI();
        abstract public function setDNI($DNI);
        abstract public function getProvince();
        abstract public function setProvince($province);
        abstract public function getCity();
        abstract public function setCity($city);
        abstract public function getPhone();
        abstract public function setPhone($phone);
        abstract public function getAddress();
        abstract public function setAddress($address);

    }

?>