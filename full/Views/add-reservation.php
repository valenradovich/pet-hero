<?php 
  include('header.php');
  include('nav-bar-owner.php');
?>
<!-- ################################################################################################ -->
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">&#8505;Full information about the Keeper!</h3>
    <?php
      foreach ($keeperList as $keeper) {
        if($keeper->getId() == $_GET['id_keeper']){
    ?>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getFullname()?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getEmail() ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getPhone() ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">DNI</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getDNI()?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getAddress() ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">City</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getLiveIn() ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-start">
            <div class="text-center">
            <img src= <?php echo UPLOADS_PATH.$keeper->getPhoto()?> alt="<?php echo $keeper->getPhoto()?>"
              class="rounded-circle img-fluid" style="width: 150px;">
            </div>
            <h5 class="my-3">Specifications:</h5>
            <?php 
              foreach($specList as $spec) {
                if ($spec->getIdKeeper() == $keeper->getId()) {
            ?>
            <div>
              <p class="mb-0">Price per day:</p>
              <p class="text-muted mb-2">$<?php echo $spec->getPricePerDay()?></p>
            </div> 
            <div>
              <p class="mb-0">Size of pets accepted:</p>
              <p class="text-muted mb-2"><?php echo $spec->getAllStringPetsSize()?></p>
            </div> 
            <?php
                }
              }
            ?>
            <?php
              foreach ($dateList as $date) {
                if($date->getIdUser() == $keeper->getId()){
            ?>
            <div>
              <p class="mb-0">Dates:</p>
              <p class="text-muted mb-2"><?php echo $date->getStartDate()?> to <?php echo $date->getEndDate()?></p>
            </div> 
            <?php
                }
              }
            ?>
          </div>
        </div>
      </div>
      <form action="<?php echo FRONT_ROOT . "reservation/add" ?>" method="post">
      <div class="col-lg">
      <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">&#128221;Check the form to send your reservation!</h3>
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Pet</p>
              </div>
              <div class="col-sm-9">
                <select class="form-select" name= "id_pet" required>
                <?php
                  foreach($petList as $pet) {
                    if ($pet->getIdOwner() == $_SESSION['loggedUser']['id']) {
                      if($pet->getSize()==1 && $spec->getSmallPets()==1) {  
                ?>
                  <option selected value="<?php echo $pet->getId()?>"><?php echo $pet->getName()?></option>
                <?php
                    } else if ($pet->getSize()==2 && $spec->getMediumPets()==1) {
                ?>
                  <option selected value="<?php echo $pet->getId()?>"><?php echo $pet->getName()?></option>
                <?php
                    } else if ($pet->getSize()==3 && $spec->getLargePets()==1) {

                ?>
                  <option selected value="<?php echo $pet->getId()?>"><?php echo $pet->getName()?></option>
                <?php
                    }
                  }
                }
                ?>
                </select>  
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Price per day</p>
              </div>
              <div class="col-sm-9">
                <select class="form-select" name="price" required>
                <?php
                  foreach($specList as $spec) {
                    if ($spec->getIdKeeper() == $keeper->getId()) {
                ?>
                <option selected value="<?php echo $spec->getPricePerDay() ?>">
                  $<?php echo $spec->getPricePerDay() ?>
                </option>
                <?php
                    }
                  }
                ?>
                </select>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Keeper's name</p>
              </div>
              <div class="col-sm-9">
                <select class="form-select" name="id_keeper" required>
                  <option selected value="<?php echo $keeper->getId() ?>"><?php echo $keeper->getFullname() ?></option>
                </select>
              </div>
            </div>
            <hr>
            <div class="row">
            <?php
              foreach ($dateList as $date) {
                if($date->getIdUser() == $keeper->getId()){
            ?>
              <div class="col-sm-3">
                <p class="mb-0">Keeper's date range</p>
              </div>
              <div class="col-sm-9">
                <select class="form-select" name="id_date">
                <option selected value="<?php echo $date->getIdDate() ?>">
                  <?php echo $date->getStartDate()?> to <?php echo $date->getEndDate()?>
                </option>
                </select>
              </div>
              <?php
                }
              }
              ?>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Start Pet Stay</p>
              </div>
              <div class="col-sm-9">
                <select class="form-select" name="start_date">
                <option selected value="<?php echo $_GET['start_date'] ?>">
                  <?php echo $_GET['start_date'] ?>
                </option>
                </select>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">End Pet Stay</p>
              </div>
              <div class="col-sm-9">
                <select class="form-select" name="end_date">
                <option selected value="<?php echo $_GET['end_date'] ?>">
                  <?php echo $_GET['end_date'] ?>
                </option>
                </select>
              </div>
            </div>
            <hr>
            <div class="row">
            <div class="d-flex justify-content-center mb-2">
              <button type="submit" class="btn btn-success">Confirm Reservation&#128512;</button>
            </div>
            </div>
          </div>
        </div>
      </div>
      </form>
      <?php
                }
              }
              
      ?>
    </div>
  </div>
</section>

<!-- ################################################################################################ -->
<?php 
  include('footer.php');
?>