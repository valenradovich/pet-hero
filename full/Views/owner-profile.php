<?php 
  include('header.php');

  include('nav-bar-owner.php');

  require_once("validate-session.php");

?>
<!-- ################################################################################################ -->
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="<?php echo UPLOADS_PATH.$_SESSION["loggedUser"]["photo"]?>" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?php echo $_SESSION["loggedUser"]["full_name"]?></h5>
            <p class="text-muted mb-1"><?php echo $_SESSION["loggedUser"]["user_type_string"]?> of Pets</p>
            <p class="text-muted mb-4"><?php echo $_SESSION["loggedUser"]["live_place"]?></p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary">Edit Profile</button>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <h5 class="my-3 ms-3">&#128179; Your Payment Coupons</h5>
            <hr>
            <div class ="p-1 ms-3">
              <?php
                foreach($paymentCouponList as $p_coupon) {
                  if ($p_coupon->getIdOwner() == $_SESSION["loggedUser"]["id"]) {                       
              ?> 
              <h5 class ="mb-3">Operation Details</h5>
              <small class="text-muted mb-3">*remember that the total of the payment coupon is only 50% of the final value.</small>
              <div class ="mb-3 mt-3">
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
              <div class="text-center mb-3">
                  <a 
                    href="<?php echo FRONT_ROOT."paymentcoupon/showAddView?id=".$p_coupon->getId()."&status=paid" ?>" type="button" class ="btn btn-info">
                    Pay online&#128521;
                  </a>
              </div>              
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
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["full_name"]?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["email"]?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["phone"]?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">DNI</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["dni"]?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION["loggedUser"]["address"]?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
            <h5 class="my-3">&#128229;Your Reservations</h5>
            </div>
            <?php
              foreach($reservationList as $reservation) {
                if ($reservation->getIdOwner() == $_SESSION["loggedUser"]["id"]) { 
                  foreach($keeperList as $keeper) {
                    if ($keeper->getId() == $reservation->getIdKeeper()) {
                      foreach($petList as $pet) {
                        if ($pet->getId() == $reservation->getIdPet()) {
                    
            ?>
            <ul class="list-group list-group-light">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <img src="<?php echo UPLOADS_PATH.$keeper->getPhoto()?>" class="rounded-circle" alt=""
                      style="width: 120px; height: 120px" />
                  <div class="ms-3">
                    <p class="fw-bold mb-1"><?php echo $keeper->getFullName()?></p>
                    <p class="text-muted mb-0">&#128231;<?php echo $keeper->getEmail()?></p>
                    <p class="text-muted mb-0">&#128222;<?php echo $keeper->getPhone()?></p>
                    <p class="text-muted mb-0">&#128197;<?php echo $reservation->getDateRange()?></p>
                    <p class="text-muted mb-0">
                      <?php echo $pet->getPetTypeString()?><?php echo $pet->getName()?>,
                      <?php echo $pet->getBreedString() ?>
                    </p>
                    <br>
                    <p class="text-muted mb-0">Reservation Code: #<?php echo $reservation->getIdReservation() ?></p>
                    
                    <div class="d-flex justify-content-center mt-3 text-center">
                      <a href="#" type="button" class ="btn btn-dark">&#9993;</a>
                    </div>
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
    if (isset($_GET['title'])){

      $alert = [
        "title" => $_GET['title'],
        "text" => $_GET['text'],
        "icon" => $_GET['icon']
    ];
    }
?>
<script>
  swal("<?php echo $alert['title']?>", "<?php echo $alert['text']?>", "<?php echo $alert['icon']?>");
</script>
<?php
  } 
?>