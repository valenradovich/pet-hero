<?php
    namespace DAO;

    use DAO\IUserDao as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO
    {
        private $userList = array();
        private $fileName = ROOT."Data/Users.json";

        public function Add(User $user)
        {
            $this->RetrieveData();
            
            if ($this->validate_duplicate_user($user)==false) {
                
                $user->setId($this->GetNextId());
            
                array_push($this->userList, $user);
    
                $this->SaveData(); 
            }
            
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }

        public function Remove($id)
        {            
            $this->RetrieveData();
            
            $this->userList = array_filter($this->userList, function($user) use($id){                
                return $user->getUsername() != $id;
            });
            
            $this->SaveData();
        }

        public function getByEmail($email)
        {
            $user = null;

            $this->RetrieveData();

            $users = array_filter($this->userList, function($user) use($email){
                return $user->getEmail() == $email;
            });

            $users = array_values($users); //Reordering array indexes

            return (count($users) > 0) ? $users[0] : null;
        }

        private function RetrieveData()
        {
             $this->userList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $user = new User();
                     $user->setId($content["id"]);
                     $user->setFirstName($content["first_name"]);
                     $user->setLastName($content["last_name"]);
                     $user->setPassword($content["password"]);
                     $user->setEmail($content["email"]);
                     $user->setDNI($content["DNI"]);
                     $user->setProvince($content["province"]);
                     $user->setCity($content["city"]);

                     array_push($this->userList, $user);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray = array();
                $valuesArray["id"] = $user->getId();
                $valuesArray["first_name"] = $user->getFirstName();
                $valuesArray["last_name"] = $user->getLastName();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["DNI"] = $user->getDNI();
                $valuesArray["province"] = $user->getProvince();
                $valuesArray["city"] = $user->getCity();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->userList as $user)
            {
                $id = ($user->getId() > $id) ? $user->getId() : $id;
            }

            return $id + 1;
        }

        private function validate_duplicate_user(User $user) {
            $this->RetrieveData();

            $duplicate = false;

            foreach($this->userList as $userAux) {

                if($userAux->getEmail() == $user->getEmail()) {
                    $duplicate = true;
                    break;
                }
            }
            return $duplicate;
        }
    }
?>