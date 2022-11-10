<?php 
    include_once('header.php');
?>
<!-- ################################################################################################ -->
<div style=margin-left:3%>
  <header> 
    <div>
      <div>  
          <h1 class ="nombre-web">    
            Cute Paws
          </h1>
      </div>
    </div>
  </header>
</div>
<!-- ################################################################################################ -->
<?php 
    include('nav-bar-register.php');
?>
<!-- ################################################################################################ -->
<div class = "background-home">
  <div class="container p-3">
    <section>
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col">
            <div class="card card-registration my-4">
              <div class="row g-0">
                <div class="col-xl-6 d-none d-xl-block align-bottom">
                  <img src="https://themeisle.com/wp-content/plugins/illustration/imgs/114.svg"
                    alt="Sample photo" class="img-fluid"
                    style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                </div>
                <div class="col-xl-6">
                  <div class="card-body p-md-5 text-black">
                    <h3 class="mb-5 text-uppercase">Keeper registration</h3>
                  <form action="<?php echo  FRONT_ROOT."Keeper/Register" ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="text" name="first_name" required id="form3Example1m" class="form-control form-control-lg" />
                          <label class="form-label" for="form3Example1m">First name</label>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="text" name="last_name" required id="form3Example1n" class="form-control form-control-lg" />
                          <label class="form-label" for="form3Example1n">Last name</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="password" name="password" required id="form3Example1m1" class="form-control form-control-lg" />
                          <label class="form-label" for="form3Example1m1">Password</label>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input type="text" name="dni" required id="form3Example1n1" class="form-control form-control-lg" />
                          <label class="form-label" for="form3Example1n1">DNI</label>
                        </div>
                      </div>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" name="address" required id="form3Example8" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example8">Address</label>
                    </div>  
                    <div class="row">
                      <div class="col-md-6 mb-4">

                        <select class="select" name="id_province" required>  
                            <?php 
                              foreach($provinceList as $province) { 
                            ?>
                              <option value="<?php echo $province->getId(); ?>"><?php echo $province->getName(); ?></option>
                            <?php 
                              } 
                            ?>      
                          </select>

                      </div>
                      <div class="col-md-6 mb-4">

                          <select class="select" name ="id_city" required>
                            <?php 
                              foreach($cityList as $city) { 
                                if ($city->getId_Province() == 1) {
                            ?>
                              <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                            <?php 
                              } 
                            }
                            ?>
                          </select>

                      </div>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="email" name ="email" required id="form3Example9" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example9">Email</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" name="phone" id="form3Example90" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example90">Phone</label>
                    </div>
                    <div class="form-outline">
                      <input type="file" class="form-control form-label" id="photo" name ="photo" required/>
                      <label class="form-label" for="photo">Profile photo</label>
                    </div>
                    <div class="d-flex justify-content-end pt-3">
                      <input type="submit" class="btn btn-success btn-lg ms-2" value="Register"></button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<!-- ################################################################################################ -->

<?php 
  include('footer.php');
?>