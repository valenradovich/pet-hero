<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use Models\Owner as Owner;

    use DAO\ProvinceDAO as ProvinceDAO;
    use DAO\CityDAO as CityDAO;
    use DAO\DateDAO as DateDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\PaymentCouponDAO as PaymentCouponDAO;

    use Exception;

    class OwnerController
    {
        private $ownerDAO;

        public function __construct()
        {
            $this->ownerDAO = new OwnerDAO();
            $this->provinceDAO = new ProvinceDAO();
            $this->cityDAO = new CityDAO();
            $this->dateDAO = new DateDAO();
            $this->reservationDAO = new ReservationDAO();
            $this->keeperDAO = new KeeperDAO();
            $this->petDAO = new PetDAO();
            $this->paymentCouponDAO = new PaymentCouponDAO();
        }

        public function RegisterView($alert = "")
        {
            $provinceList = $this->provinceDAO->GetAll();
            $cityList = $this->cityDAO->GetAll();
            require_once(VIEWS_PATH."register-owner.php");
        }

        public function Register($first_name, $last_name, $password, $email, $dni, $id_province, $id_city, 
                                 $phone, $address, $photo) {
            
            try {
                $fileName = $photo["name"];
                $tempFileName = $photo["tmp_name"];
                $type = $photo["type"];
 
                $filePath = ROOT."Imgs/".basename($fileName);           
                
                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
 
                $imageSize = getimagesize($tempFileName);
 
                if($imageSize !== false) {

                    if (move_uploaded_file($tempFileName, $filePath)) {

                        $owner = new Owner();
                        $owner->setFirstName($first_name);
                        $owner->setLastName($last_name);
                        $owner->setEmail($email);
                        $owner->setPassword($password);
                        $owner->setDNI($dni);
                        $owner->setProvince($id_province);
                        $owner->setCity($id_city);
                        $owner->setPhone($phone);
                        $owner->setAddress($address);
                        $owner->setPhoto($fileName);

                        $this->ownerDAO->Add($owner);

                        $alert = [
                            "title" => "Success",
                            "text" => "Registration completed, you can now log in",
                            "icon" => "success"
                        ];

                        $this->LoginView($alert);
                    }
                }

            } catch (Exception $ex) {
                $alert = [
                    "title" => "Error",
                    "text" => "Account could not be registered, try again",
                    "icon" => "error"
                ];

                $this->RegisterView($alert);    
            }   
            
        }

        public function LoginView($alert = "")
        {
            require_once(VIEWS_PATH."login-owner.php");
        }
        
        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-pet.php");
        }

        public function ownerprofile($alert="") {
            $reservationList = $this->reservationDAO->GetAll();
            $keeperList = $this->keeperDAO->GetAll();
            $petList = $this->petDAO->GetAll();
            $paymentCouponList = $this->paymentCouponDAO->GetAll();

            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."owner-profile.php");
        }

        public function Login($email, $password) {
            try {
                $owner = $this->ownerDAO->GetByEmail($email);
                
                if(($owner != null) && ($owner->getPassword() === $password)&&($owner->getUserType() == 1))
                {
                    $_SESSION["loggedUser"] = array(
                    "id"=>$owner->getId(),
                    "firstname"=>$owner->getFirstName(),
                    "lastname"=>$owner->getFirstName(),
                    "email"=>$owner->getEmail(),
                    "dni"=>$owner->getDNI(),
                    "id_province"=>$owner->getProvince(), 
                    "id_city"=>$owner->getCity(),
                    "live_place"=>$owner->getLiveIn(),
                    "phone"=>$owner->getPhone(),
                    "user_type"=>$owner->getUserType(),
                    "user_type_string"=>$owner->getUserTypeString(),
                    "photo"=>$owner->getPhoto(),
                    "full_name"=>$owner->getFullName(),
                    "address"=>$owner->getAddress());
                    
                    $alert = [
                        "title" => "Success",
                        "text" => "Session successfully logged in",
                        "icon" => "success"
                    ];
                                        

                    $this->ownerprofile($alert);
                } else {
                    $alert = [
                        "title" => "Error",
                        "text" => "Incorrect user name and/or password",
                        "icon" => "error"
                    ];
                    $this->LoginView($alert);
                }

            } catch (Exception $ex) {
                $alert = [
                    "title" => "Error",
                    "text" => "Incorrect user name and/or password",
                    "icon" => "error"
                ];
                $this->LoginView($alert);
            } 
        }
        
        public function Logout()
        {
            session_destroy();

            $this->LoginView();
        }
    }
