<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class HomeController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }
        
        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-cellphone.php");
        }

        public function Login($email, $password)
        {
            $user = $this->userDAO->getByEmail($email);

            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;
                # $_SESSION["id"] = $user->getID();
                $this->ShowAddView();
            }
            else
                $this->Index("Usuario y/o Contraseña incorrectos");
        }
        
        public function Logout()
        {
            session_destroy();

            $this->Index();
        }
    }
?>