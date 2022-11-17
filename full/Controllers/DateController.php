<?php
    namespace Controllers;

    use DAO\DateDAO as DateDAO;
    use Models\Date as Date;

    use Exception;

    class DateController {
            
        private $dateDAO;

        public function __construct()
        {
            $this->dateDAO = new DateDAO();
        }

        public function ShowAddView($alert="")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-date.php");
        }

        public function ShowListView()
        {
            $dateList = $this->dateDAO->getAll();
            
            require_once(VIEWS_PATH."date-list.php");
        }

        public function Add($start_date, $end_date) {  
            
            try {
                $date = new Date();
                $date->setStartDate($start_date);
                $date->setEndDate($end_date);
                $date->setIdUser($_SESSION["loggedUser"]["id"]);
                $date->setEstado(true);

                $this->dateDAO->Add($date);
                
                $alert = [
                    "title" => "Success",
                    "text" => "Date successfully uploaded",
                    "icon" => "success"
                ];

                $this->ShowAddView($alert);
            } catch (Exception $ex) {
                
                $alert = [
                    "title" => "Error",
                    "text" => "The requested date range could not be entered, check if you have one uploaded.",
                    "icon" => "error"
                ];
                $this->ShowAddView($alert);
            }
            
        }

        public function Remove($id_dateRange)
        {
            try {
                $this->dateDAO->Remove($id_dateRange);

                $this->ShowListView();
            } catch (\Throwable $th) {
                $this->ShowListView();
            }
            
        }

        public function GetAll()
        {
            $dateList = $this->dateDAO->GetAll();
        }

        public function getByUserId($id_user)
        {
            $dateList = $this->dateDAO->GetByUserId($id_user);
 
        }

        public function filter_by_dates($start_date, $end_date)
        {
            $dateListFilter = $this->dateDAO->filter_by_dates($start_date, $end_date);
            $_SESSION["loggedUser"]["keepersBetween"] = $dateListFilter;
            
            header("location: ".FRONT_ROOT."keeper/ShowListView?start_date=".$start_date."&end_date=".$end_date);
            
        }

        
        
    }
