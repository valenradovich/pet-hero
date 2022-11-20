<?php 
  include('header.php');
  include('nav-bar-owner.php');
?>
<!-- ################################################################################################ -->
<section class="bg-secondary responsive">
  <div class="container p-3 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
        <?php
            if (!isset ($_GET['id_pet_type'])) {

          ?>
          <div class ="mt-4 pt-2 text-center">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Add your pet!</h3>
              <form action="" method="get">
              <div class="text-center">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="id_pet_type" id="id_pet_type"
                        value="2" checked />
                      <label class="form-check-label" for="id_pet_type">&#128008;</label>
                    </div>
                      <label class="me-3">or  </label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="id_pet_type" id="id_pet_type"
                        value="1" />
                      <label class="form-check-label" for="id_pet_type">&#128021;</label>
                    </div>
               </div>
               <div class = "text-center m-4">
               <button type="submit" class="btn btn-success btn-block mb-4 btn-sm">
                  Upload info! 
               </button>
               </div>              
              </form>
          </div>
          <?php
            }
          ?>
          <?php
            if (isset ($_GET['id_pet_type'])) {

              $id_pet_type = $_GET['id_pet_type'];

              if ($id_pet_type == 1) {
                $icon_pet = "&#128021;";
              } else {
                $icon_pet = "&#128008;";
              }
          ?>
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Enter your <?php echo $icon_pet?> information</h3>
            <form action="<?php echo  FRONT_ROOT."pet/add?id_pet_type=".$id_pet_type ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name = "name_pet" id="name_pet" class="form-control form-label" required/>
                    <label class="form-label" for="name_pet">Name</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="file" class="form-control form-label" id="photo" name ="photo" 
                     required/>
                    <label class="form-label" for="photo">Profile photo</label>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-5 d-flex align-items-center">
                  <select class="form-select" name= "id_breed" required>
                    <option selected disabled>Select a Breed</option>
                    <?php 
                      foreach($breedList as $breed) { 
                        if($breed->getPetType() == $id_pet_type) {
                    ?>
                      <option value="<?php echo $breed->getId(); ?>"><?php echo $breed->getName(); ?></option>
                    <?php 
                        }
                      } 
                    ?>    
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
                       />
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
          </div>
          <?php
            }
          ?>
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
<!-- ################################################################################################ -->

<?php 
  include('footer.php');
?>