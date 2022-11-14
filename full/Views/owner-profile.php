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
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <span class="material-symbols-outlined">
                  event_upcoming
                  </span>
                  <a class="mb-0" href="<?php echo FRONT_ROOT."date/showlistview "?>" style= color:#198754;>
                    My dates
                  </a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <p class="mb-0"><?php echo $_SESSION["loggedUser"]["id"]?></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">-</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <p class="mb-0">-</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">-</p>
              </li>
            </ul>
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
                    <div class="d-flex justify-content-center mt-3">
                      <a href="#" type="button" class ="btn btn-dark">Message</a>
                    </div>
                  </div>
                </div>
                <span class="badge bg-warning text-dark"><?php echo $reservation->getStatus()?></span>
              </li>
                <!--<span class="badge rounded-pill badge-warning">Awaiting</span>-->
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