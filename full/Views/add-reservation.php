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
              <p class="mb-0">Size of pets:</p>
              <p class="text-muted mb-2"><?php echo $spec->getPetSizeString()?></p>
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
                ?>
                  <option selected value="<?php echo $pet->getId()?>"><?php echo $pet->getName()?></option>
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
            <?php
                }
              }
            ?>
              <div class="col-sm-9">
                <select class="form-select" name="id_date">
                <option selected value="<?php echo $date->getIdDate() ?>">
                  <?php echo $date->getStartDate()?> to <?php echo $date->getEndDate()?>
                </option>
                </select>
              </div>
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
<!--<section class="vh-100 bg-secondary responsive">
  <div class="container p-3 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">

            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Full information about the Keeper!</h3>
            <?php
              foreach ($keeperList as $keeper) {
                if($keeper->getId() == $_GET['id_keeper']){
            ?>
              <form action="<?php echo  FRONT_ROOT."reservation/add" ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="name_pet">Name: <?php echo $keeper->getFullName() ?></label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="photo">Date Range: <?php echo $keeper->getDateRange()?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-5 d-flex align-items-center">
                    <select class="form-select" name= "id_breed" required>
                      <option selected disabled>Select a Breed</option>
                      <option value="1">Subject 1</option>
                      <option value="2">Subject 2</option>
                      <option value="3">Subject 3</option>
                    </select>              
                  </div>         
                  <div class="col-md-6 mb-4">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="id_size" id="id_size"
                        value="1" checked />
                      <label class="form-check-label" for="id_size">Small</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="id_size" id="id_size"
                        value="2" />
                      <label class="form-check-label" for="id_size">Medium</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="id_size" id="id_size"
                        value="3" />
                      <label class="form-check-label" for="id_size">Large</label>
                    </div>

                  </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">
                  <div class="form-outline">
                      <input type="file" class="form-control form-label" id="vaccines" name ="vaccines" 
                      required/>
                      <label class="form-label" for="vaccines">Vaccines photo</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input type="file" class="form-control form-label" id="video" name ="video" 
                        required/>
                        <label class="form-label" for="video">Upload a video</label>
                      </div>
                  </div>
                </div>
                <div >
                  <div class="input-group">
                    <textarea class="form-control" name= "description"aria-label="With textarea"></textarea> 
                  </div>
                  <label class="form-label" for="description">Something to add</label>
                </div>
                <div class="mt-4 pt-2">
                  <input class="btn btn-success btn-lg" type="submit" value="Submit" />
                </div>
              </form>
            <?php
                }
              }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
-->
<!-- ################################################################################################ -->

<?php 
  include('footer.php');
?>