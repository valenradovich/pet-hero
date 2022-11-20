<?php
    namespace Controllers;

    use DAO\PaymentCouponDAO as PaymentCouponDAO;
    use Models\PaymentCoupon as PaymentCoupon;

    use Exception;

    class PaymentCouponController {
        private $paymentCouponDAO;

        public function __construct() {
            $this->paymentCouponDAO = new PaymentCouponDAO();
        }

        public function showAddView() {
            $couponList = $this->paymentCouponDAO->GetAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-pay.php");
        }

        public function add($id_r, $id_o, $amount) {
            try {
                $paymentCoupon = new PaymentCoupon();
                $paymentCoupon->setIdReservation($id_r);
                $paymentCoupon->setIdOwner($id_o);
                $paymentCoupon->setIdKeeper($_SESSION["loggedUser"]["id"]);
                $paymentCoupon->setAmount($amount);

                $this->paymentCouponDAO->add($paymentCoupon);

                $alert = [
                    "title" => "Success",
                    "text" => "Payment Coupon successfully uploaded",
                    "icon" => "success"
                ];

                header("location:" . FRONT_ROOT . "keeper/keeperprofile");
            } catch (Exception $ex) {
                $alert = [
                    "title" => "Error",
                    "text" => "Payment Coupon could not be entered",
                    "icon" => "error"
                ];

                header("location:" . FRONT_ROOT . "keeper/keeperprofile");
            }
        }

        public function remove($id) {
            try {
                $this->paymentCouponDAO->remove($id);

                header("location:" . FRONT_ROOT . "owner/ownerprofile");
            } catch (Exception $ex) {

                header("location:" . FRONT_ROOT . "keeper/ownerprofile");
            }
        }

        public function update($id, $status) {
            try {
                $this->paymentCouponDAO->update($id, $status);

                header("location:" . FRONT_ROOT . "owner/ownerprofile");
            } catch (Exception $ex) {

                header("location:" . FRONT_ROOT . "owner/ownerprofile");
            }
        }
    }

?>