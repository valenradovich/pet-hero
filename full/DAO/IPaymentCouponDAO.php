<?php
    namespace DAO;

    use Models\PaymentCoupon as PaymentCoupon;

    interface IPaymentCouponDAO
    {
        function Add(PaymentCoupon $p_coupon);
        function GetAll();
        function Remove($p_coupon);
        function getById($p_coupon);
    }
?>