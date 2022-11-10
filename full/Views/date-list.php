<?php 
 include('header.php');
 include('nav-bar-keeper.php');
?>
<!-- ################################################################################################ -->
<form action="<?php echo FRONT_ROOT."date/remove" ?>" method="post">
<div class="container p-5">
    <div class="row">
    <?php
      foreach($dateList as $date) {
        if ($date->getIdUser() == $_SESSION['loggedUser']["id"]) {
    ?>
      <div class="col-xl-4 col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <p> &#128467;  </p>
              <div class="ms-3">
                <p class="fw-bold mb-1">Start date</p>
                <p class="text-muted mb-0"><?php echo $date->getStartDate() ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <p> &#128467;  </p>
              <div class="ms-3">
                <p class="fw-bold mb-1">End</p>
                <p class="text-muted mb-0"><?php echo $date->getEndDate() ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <p>&#128229;</p>
              <div class="ms-3">
                <button type="submit" name="id_dateRange" class="btn btn-dark" value="<?php echo $date->getIdDate() ?>"> Remove </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
          }
        }
      ?>   
    </div>
  </div>
</form>
<!-- ################################################################################################ -->
<?php 
  include('footer.php');
?>