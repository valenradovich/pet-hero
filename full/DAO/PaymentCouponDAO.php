<?php
    namespace DAO;

    use DAO\IPaymentCouponDAO as IPaymentCouponDAO;
    use Models\PaymentCoupon as PaymentCoupon;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Exception;

    class PaymentCouponDAO implements IPaymentCouponDAO {
        private $connection;
        private $tableName = "paymentCoupons";

        # manejar dentro de bloque try catch todo dentro del DAO
        public function add(PaymentCoupon $p_coupon)
        {
            try {
                $query = "CALL pay_coupons_add(?, ?, ?, ?)";

                $parameters["id_reservation"] = $p_coupon->getIdReservation();
                $parameters["id_owner"] = $p_coupon->getIdOwner();
                $parameters["id_keeper"] = $p_coupon->getIdKeeper();
                $parameters["amount"] = $p_coupon->getAmount();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure); 

            } catch (Exception $ex) {
                echo 'error';
            }     
        }

        public function getAll() {
            try {
                $couponList = array();

                $query = "CALL pay_coupons_get_all()";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

                foreach($result as $row) {
                    $coupon = new PaymentCoupon();
                    $coupon->setId($row["id_payment_coupon"]);
                    $coupon->setIdReservation($row["id_reservation"]);
                    $coupon->setIdOwner($row["id_owner"]);
                    $coupon->setIdKeeper($row["id_keeper"]);
                    $coupon->setStatus($row["status"]);
                    $coupon->setIssueDate($row["issue_date"]);
                    $coupon->setAmount($row["amount"]);
                    $coupon->setPayDate($row["pay_date"]);

                    array_push($couponList, $coupon);
                }

                return $couponList;
            } catch (Exception $ex) {
                echo 'error';
            }
        }

        public function Remove($id)
        {
            $query = "CALL pay_coupons_remove(?)";

            $parameters["id_payment_coupon"] = $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        public function getById($id_payment_coupon)
        {
            $reservation = null;
            
            $query = "CALL pay_coupons_get_by_id(?)";

            $parameters["id_payment_coupon"] = $id_payment_coupon;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($result as $row) {
                $coupon = new PaymentCoupon();
                $coupon->setId($row["id_payment_coupon"]);
                $coupon->setIdReservation($row["id_reservation"]);
                $coupon->setIdOwner($row["id_owner"]);
                $coupon->setIdKeeper($row["id_keeper"]);
                $coupon->setStatus($row["status"]);
                $coupon->setIssueDate($row["issue_date"]);
                $coupon->setAmount($row["amount"]);
                $coupon->setPayDate($row["pay_date"]);
            }

            return $coupon;

        }

        public function Update($id, $status) {
            try {
                $query = "CALL pay_coupons_update(?, ?)";

                $parameters["id_reservation"] = $id;
                $parameters["status"] = $status;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
                
            } catch (Exception $ex) {
                //throw $th;
            }

            
        }

        /*public function validation($id_keeper, $id_date) {
            try {
                $reservationList = array();

                $query = "CALL reservations_by_idk_idDate_status(?, ?, ?)";

                $parameters["id_keeper"] = $id_keeper;
                $parameters["id_date"] = $id_date;
                $parameters["status"] = "accepted";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                foreach ($result as $row)
                {
                    $reservation = new Reservation();
                    $reservation->setIdReservation($row["id_reservation"]);
                    $reservation->setIdOwner($row["id_owner"]);
                    $reservation->setIdPet($row["id_pet"]);
                    $reservation->setIdBreed($row["id_breed"]);
                    $reservation->setIdKeeper($row["id_keeper"]);
                    $reservation->setPrice($row["price"]);
                    $reservation->setIdDate($row["id_date"]);
                    $reservation->setStatus($row["status"]);
                    $reservation->setOrderDate($row["order_date"]);
                    $reservation->setStartDate($row["start_date"]);
                    $reservation->setEndDate($row["end_date"]);
    
                    array_push($reservationList, $reservation);
                }
    
                return $reservationList;
                
            } catch (Exception $ex) {
                echo 'error en validation db reservation';
            }
        }*/
    }

?>