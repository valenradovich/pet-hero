<?php
    namespace Controllers;

    use DAO\KeeperDAO as KeeperDAO;
    use Models\Keeper as Keeper;

    use DAO\ProvinceDAO as ProvinceDAO;
    use DAO\CityDAO as CityDAO;
    use DAO\DateDAO as DateDAO;
    use DAO\SpecDAO as SpecDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\PaymentCouponDAO as PaymentCouponDAO;

    use Exception;

    class KeeperController
    {
        private $keeperDAO;

        public function __construct()
        {
            $this->keeperDAO = new KeeperDAO();
            $this->provinceDAO = new ProvinceDAO();
            $this->cityDAO = new CityDAO();
            $this->dateDAO = new DateDAO();
            $this->specDAO = new SpecDAO();
            $this->reservationDAO = new ReservationDAO();
            $this->ownerDAO = new OwnerDAO();
            $this->petDAO = new PetDAO();
            $this->paymentCouponDAO = new PaymentCouponDAO();
        }

        public function RegisterView($alert = "")
        {
            $provinceList = $this->provinceDAO->GetAll();
            $cityList = $this->cityDAO->GetAll();
            require_once(VIEWS_PATH."register-keeper.php");
        }

        public function Register($first_name, $last_name, $password, $email, $dni, $id_province, $id_city, $phone, 
                                 $address, $photo) {    
            try {            
                $fileName = $photo["name"];
                $tempFileName = $photo["tmp_name"];
                $type = $photo["type"];
                
                #   esta ruta funcionó, cambiar el resto con esta
                $filePath = ROOT."Imgs/".basename($fileName);          
                
                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    
                $imageSize = getimagesize($tempFileName);
                
 
                if($imageSize !== false) {

                    if (move_uploaded_file($tempFileName, $filePath)) {

                        $keeper = new Keeper();
                        $keeper->setFirstName($first_name);
                        $keeper->setLastName($last_name);
                        $keeper->setEmail($email);
                        $keeper->setPassword($password);
                        $keeper->setDNI($dni);
                        $keeper->setProvince($id_province);
                        $keeper->setCity($id_city);
                        $keeper->setPhone($phone);
                        $keeper->setAddress($address);
                        $keeper->setPhoto($fileName);
            
                        $this->keeperDAO->Add($keeper);

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
            require_once(VIEWS_PATH."login-keeper.php");
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-date.php");
        }

        public function ShowListView()
        {
            $keeperList = $this->keeperDAO->getAll();
            $dateList = $this->dateDAO->getAll();
            $specList = $this->specDAO->getAll();
            # $reservationList = $this->reservationDAO->getAll();

            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."keeper-list.php");
        }

        public function keeperprofile($alert="") {
            $specList = $this->specDAO->getAll();
            $dateList = $this->dateDAO->getAll();
            $reservationList = $this->reservationDAO->getAll();
            $ownerList = $this->ownerDAO->getAll();
            $petList = $this->petDAO->getAll();
            $paymentCouponList = $this->paymentCouponDAO->getAll();

            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."keeper-profile.php");
        }

        public function Login($email, $password)
        {
            try {
                $keeper = $this->keeperDAO->getByEmail($email);

                if(($keeper != null) && ($keeper->getPassword() === $password) && ($keeper->getUserType()==2) )
                {
                    $_SESSION["loggedUser"] = array(
                                                    "id"=>$keeper->getId(),
                                                    "firstname"=>$keeper->getFirstName(),
                                                    "lastname"=>$keeper->getFirstName(),
                                                    "email"=>$keeper->getEmail(),
                                                    "dni"=>$keeper->getDNI(),
                                                    "id_province"=>$keeper->getProvince(), 
                                                    "id_city"=>$keeper->getCity(),
                                                    "live_place"=>$keeper->getLiveIn(),
                                                    "phone"=>$keeper->getPhone(),
                                                    "user_type"=>$keeper->getUserType(),
                                                    "user_type_string"=>$keeper->getUserTypeString(),
                                                    "photo"=>$keeper->getPhoto(),
                                                    "full_name"=>$keeper->getFullName(),
                                                    "address"=>$keeper->getAddress(),
                                                    );
                    $alert = [
                        "title" => "Success",
                        "text" => "Session successfully logged in",
                        "icon" => "success"
                    ];
    
                    $this->keeperprofile($alert); 
    
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



?>