<?php
  include('header.php');
  include('nav-bar-keeper.php');
?>
<!-- ################################################################################################ -->
<!-- Section: Design Block -->
<section class="container p-5 text-center">
  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
          background: hsla(0, 0%, 100%, 0.8);
          backdrop-filter: blur(30px);
          ">
    <div class="card-body py-5 px-md-5">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Add your Specifications</h2>
          <form action="<?php echo FRONT_ROOT . "spec/add" ?>" method="post">
            <div class="row">
              <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="hidden" name="small_pets" value ="0">
                        <input class="form-check-input" type="checkbox" name="small_pets" value="1"/>
                        <label class="form-check-label">Small</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="hidden" name="medium_pets" value ="0">
                      <input class="form-check-input" type="checkbox" name="medium_pets" value="1"/>
                      <label class="form-check-label">Medium</label>
                    </div>
                    <div class="form-check form-check-inline">                      
                      <input class="form-check-input" type="hidden" name="large_pets" value ="0">
                      <input class="form-check-input" type="checkbox" name="large_pets" value="1"/>
                      <label class="form-check-label">Large</label>
                    </div>
                    <label class="form-label">Pet Size Preference</label>
                  </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="number" id="price_per_day" class="form-control" name="price_per_day" min = 0 required />
                  <label class="form-label" for="price_per_day">Price per day</label>
                </div>
              </div>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-success btn-block mb-4">
              Submit
            </button>
          </form>
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