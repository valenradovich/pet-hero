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
                    <select class="form-select" name= "id_size_of_pets" required>
                      <option selected value="1">Small</option>
                      <option value="2">Medium</option>
                      <option value="3">Large</option>
                    </select>  
                    <label class="form-label" for="id_size_of_pets">Pet Size</label>
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
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
          </form>
        </div>
      </div>
    </div>
    
  </div>
</section>
<!-- ################################################################################################ -->

<?php
include('footer.php');
?>