<?php 
  include('header.php');

  include('nav-bar-keeper.php');

  require_once("validate-session.php");
?>
<!-- ################################################################################################ -->
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src= <?php echo UPLOADS_PATH.$_SESSION["loggedUser"]["photo"]?> alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?php echo $_SESSION["loggedUser"]["full_name"] ?></h5>
            <p class="text-muted mb-1"><?php echo $_SESSION["loggedUser"]["user_type_string"]?> of Pets</p>
            <p class="text-muted mb-4"><?php echo $_SESSION["loggedUser"]["live_place"]?></p>
            <div class="d-flex justify-content-center mb-2">
              <button href="#" type="button" class="btn btn-primary">Edit Specs</button>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <h5 class="my-3 ms-3">&#128179; Payment Coupons</h5>
            <hr>
            <div class ="p-1 ms-3">
              <?php
                foreach($paymentCouponList as $p_coupon) {
                  if ($p_coupon->getIdKeeper() == $_SESSION["loggedUser"]["id"]) {                       
              ?> 
              <h5 class ="mb-3">Operation Details</h5>
              <div class ="mb-3">
                <span>RESERVATION CODE: <span><strong>#<?php echo $p_coupon->getIdReservation() ?></strong></span></span> 
              </div>
              <div class ="mb-3">
                <span>TOTAL AMOUNT: <span><strong>$<?php echo $p_coupon->getAmount() ?></strong></span></span> 
              </div>
              <div class ="mb-3">
                <span>ISSUE DATE: <span><strong><?php echo $p_coupon->getIssueDate() ?></strong></span></span> 
              </div>
              <div class ="mb-3">
                <span>STATUS: <span><strong><?php echo $p_coupon->getStatus() ?></strong></span></span> 
              </div>
              <?php
                  if ($p_coupon->getStatus() == "awaiting response") {
              ?>             
              <?php
                  } else {
              ?>
              <div class ="mb-3">
                <span>PAY DATE: <span><strong><?php echo $p_coupon->getPayDate() ?></strong></span></span> 
              </div>

              <?php
                  }
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["full_name"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["email"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["phone"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">DNI</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["dni"] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["address"] ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-9">
                <h5>&#10004; Specifications</p>
              </div>
            </div>
            <hr>
            <?php
              foreach($specList as $spec) {
                if ($spec->getIdKeeper() == $_SESSION['loggedUser']["id"]) { ?>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Price per day</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $spec->getPricePerDay()?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Pet's size preference</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $spec->getAllStringPetsSize() ?></p>
              </div>
            </div>
            <hr>
            <form action="<?php echo FRONT_ROOT."spec/remove"?>" method="post">
            <div class="row">
              <div class="col-sm-3">
                <button type="submit" name="id_specification" class="btn btn-dark" value="<?php echo $spec->getId() ?>"> Remove &#128229;</button>
              </div>
            </div>
            </form>
            <?php
                }
              }
            ?>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-9">
                <h5>&#128209; Reservations Status</p>
              </div>
            </div>
            <hr>
            <!-- MOSTRAR LA RESERVA Y PODER ACEPTAR/RECHAZAR -->
            <?php
              foreach($reservationList as $reservation) {
                if ($reservation->getIdKeeper() == $_SESSION['loggedUser']["id"]) { 
                  foreach($ownerList as $owner) {
                    if ($owner->getId() == $reservation->getIdOwner()) {
                      foreach($petList as $pet) {
                        if ($pet->getId() == $reservation->getIdPet()) {
            ?>
            <ul class="list-group list-group-light">
              <li class="list-group-item d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                <img src="<?php echo UPLOADS_PATH.$owner->getPhoto()?>" class="rounded-circle" alt=""
                      style="width: 120px; height: 120px" />
                  <div class="ms-3">
                    <p class="fw-bold mb-1"><?php echo $owner->getFullName()?></p>
                    <p class="text-muted mb-0">&#128231;<?php echo $owner->getEmail()?></p>
                    <p class="text-muted mb-0">&#128222;<?php echo $owner->getPhone()?></p>
                    <p class="text-muted mb-0">
                      <?php echo $pet->getPetTypeString()?><?php echo $pet->getName()?>,
                      <?php echo $pet->getBreedString() ?>
                    </p>
                    <p class="text-muted mb-0">&#128207;<?php echo $pet->getSizeString()?></p>
                    <p class="text-muted mb-0">&#128197;<?php echo $reservation->getDateRange()?></p>
                    <br>
                    <p class="text-muted mb-0">Reservation Code: #<?php echo $reservation->getIdReservation() ?></p>
                    
                    <?php 
                      if ($reservation->getStatus() == "awaiting response") { 
                    ?>
                    <div class="d-flex justify-content-center mt-3">
                      <a href="<?php echo FRONT_ROOT . "reservation/update?status=accepted"."&id_reserv=".$reservation->getIdReservation()."&id_pet=".$pet->getId()."&id_date=".$reservation->getIdDate()?>" 
                         type="button" class ="btn btn-success ms-5">&#10004;
                      </a>
                      <a href="<?php echo FRONT_ROOT . "reservation/update?status=rejected"."&id_reserv=".$reservation->getIdReservation()."&id_pet=".$pet->getId()."&id_date=".$reservation->getIdDate()?>" 
                         type="button" class ="btn btn-danger ms-5">
                        &#10060;
                      </a>
                      <a href="#" type="button" class ="btn btn-info ms-5"><?php echo $pet->getPetTypeString()?>&#8505;</a>
                      <a href="#" type="button" class ="btn btn-dark ms-5">&#9993;</a>
                    </div>
                    <?php
                      } else if ($reservation->getStatus() == "accepted") {
                    ?>
                    <div class ="d-flex justify-content-center mt-3">
                      <a href="#" type="button" class ="btn btn-dark ms-5">&#9993;</a>
                      <a href="#" type="button" class ="btn btn-info ms-5"><?php echo $pet->getPetTypeString()?>&#8505;</a>
                      <a href="<?php echo FRONT_ROOT."paymentCoupon/add?id_r=".$reservation->getIdReservation()."&id_o=".$reservation->getIdOwner()."&amount=".$reservation->get50PercentPayment()?>" type="button" class ="btn btn-secondary ms-5">
                        &#128228;&#129534;
                      </a>
                    </div>
                    <?php
                      } else if ($reservation->getStatus() == "rejected") {
                    ?>
                    <div class ="d-flex justify-content-center mt-3">
                      <a href="#" type="button" class ="btn btn-info ms-5"><?php echo $pet->getPetTypeString()?>&#8505;</a>                          
                      <a href="#" type="button" class ="btn btn-dark ms-5">&#9993;</a>
                    </div>
                    <?php
                      }
                    ?>
                  </div>
                </div>
                <?php 
                  if($reservation->getStatus() == "awaiting response") { ?>
                    <span class="badge bg-warning rounded-pill text-dark"><?php echo $reservation->getStatus()?></span>
                <?php } else if($reservation->getStatus() == "accepted") { ?>
                    <span class="badge bg-success rounded-pill text-dark"><?php echo $reservation->getStatus()?></span>
                <?php } else if($reservation->getStatus() == "rejected") { ?>
                    <span class="badge bg-danger rounded-pill text-dark"><?php echo $reservation->getStatus()?></span>
              </li>
              <?php
                }
              ?>
            </ul>
            <?php
                  }
                }
              }
            }
          }
         }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  if($alert){
?>
<script>
  swal("<?php echo $alert['title']?>", "<?php echo $alert['text']?>", "<?php echo $alert['icon']?>");
</script>
<?php
  }
?>