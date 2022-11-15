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
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">  
                <a href="<?php echo FRONT_ROOT."date/showlistview "?>">
                <button class="mb-0 btn btn-dark">&#128467; My dates</button>
                </a>
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
            <!-- añadir bucle para poder mostrar las specs del keeper en cuestión -->
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
                <p class="mb-0">Pet's size</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $spec->getPetSizeString() ?></p>
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
                      <?php echo $pet->getBreed() ?>
                    </p>
                    <p class="text-muted mb-0">&#128207;<?php echo $pet->getSizeString()?></p>
                    <p class="text-muted mb-0">&#128197;<?php echo $reservation->getDateRange()?></p>
                    <?php 
                      if ($reservation->getStatus() == "awaiting response") { 
                    ?>
                    <div class="d-flex justify-content-center mt-3">
                      <a href="<?php echo FRONT_ROOT . "reservation/update?status=accepted"."&id=".$reservation->getIdReservation()?>" 
                         type="button" class ="btn btn-success ms-5">&#10004;
                      </a>
                      <a href="<?php echo FRONT_ROOT . "reservation/update?status=rejected"."&id=".$reservation->getIdReservation()?>" 
                         type="button" class ="btn btn-danger ms-5">
                        &#10060;
                      </a>
                      <a href="#" type="button" class ="btn btn-info ms-5"><?php echo $pet->getPetTypeString()?>info</a>
                      <a href="#" type="button" class ="btn btn-dark ms-5">&#9993;</a>
                    </div>
                    <?php
                      } else {
                    ?>
                    <div class ="d-flex justify-content-center mt-3">
                      <a href="#" type="button" class ="btn btn-info ms-5"><?php echo $pet->getPetTypeString()?>info</a>                          
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