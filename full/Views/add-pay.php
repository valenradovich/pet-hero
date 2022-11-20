<?php 
  include('header.php');
  include('nav-bar-owner.php');
?>
<!-- ################################################################################################ -->
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row d-flex justify-content-center py-5">
      <div class="col-md-7 col-lg-5 col-xl-4">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <?php
              foreach ($couponList as $p_coupon) {
                if($p_coupon->getId() == $_GET['id']){
            ?>
            <h4 class="text-success">$<?php echo $p_coupon->getAmount() ?></h4>
            <h4>Reservation Code #<?php echo $p_coupon->getIdReservation() ?></h4>
            <hr>
            <form>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-outline">
                  <input type="text" id="typeText" class="form-control form-control-lg" size="17"
                    placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" required/>
                  <label class="form-label" for="typeText">Card Number</label>
                </div>
                <img src="https://img.icons8.com/color/48/000000/visa.png" alt="visa" width="64px" />
              </div>

              <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-outline">
                  <input type="text" id="typeName" class="form-control form-control-lg" size="17"
                    placeholder="Cardholder's Name" required/>
                  <label class="form-label" for="typeName">Cardholder's Name</label>
                </div>
              </div>

              <div class="d-flex align-items-center pb-2">
                <div class="form-outline me-2">
                  <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY"
                    size="7" id="exp" minlength="7" maxlength="7" required/>
                  <label class="form-label" for="typeExp">Expiration</label>
                </div>
                <div class="form-outline">
                  <input type="password" id="typeText2" class="form-control form-control-lg"
                    placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" required/>
                  <label class="form-label" for="typeText2">Cvv</label>
                </div>
                </div>
                <div class="text-end">
                <div class="btn btn-info btn-sm btn-rounded">
                  <a 
                    href="<?php echo FRONT_ROOT."paymentcoupon/update?id=".$p_coupon->getId()."&status=paid" ?>" type="button" class ="btn btn-info">
                    Pay&#128521;
                  </a>
              </div>
                </div>
            </form>
          </div>
          <?php
                }
              }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ################################################################################################ -->
<?php 
  include('footer.php');
?>