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
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                </p>
                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                </p>
                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
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
                <a href=""<?php echo FRONT_ROOT."date/showlistview "?>>
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