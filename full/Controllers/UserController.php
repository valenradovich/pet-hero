<?php 
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function RegisterView($message = "")
        {
            require_once(VIEWS_PATH."register.php");
        }

        public function Register($first_name, $last_name, $password, $email, $DNI, $province, $city)
        {
            $user = new User();
            $user->setFirstName($first_name);
            $user->setLastName($last_name);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setDNI($DNI);
            $user->setProvince($province);
            $user->setCity($city);

            $this->userDAO->Add($user);

            $this->RegisterView("Usuario registrado con éxito");
        }
    }

?>