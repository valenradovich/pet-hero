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
          <h2 class="fw-bold mb-5">Select your working date range</h2>
          <form action="<?php echo FRONT_ROOT . "date/add" ?>" method="post">
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="date" id="start_date" class="form-control" name="start_date" min="<?php echo date('Y-m-d', time()); ?>" required />
                  <label class="form-label" for="start_date">Start Date</label>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="date" id="end_date" class="form-control" name="end_date" min="<?php echo date('Y-m-d', time()); ?>" required />
                  <label class="form-label" for="end_date">End date</label>
                </div>
              </div>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">
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