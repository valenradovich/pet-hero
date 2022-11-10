<?php
include('header.php');
include('nav-bar-owner.php');
?>
<!-- ################################################################################################ -->
<div class="container p-5 text-center">
  <h2 class="fs-5 fw-bold mb-5 text-start">&#8505;Filter by dates!</h2>
  <form action="<?php echo FRONT_ROOT."date/filter_by_dates" ?>" method="GET">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <input type="date" class="form-control" min="<?php echo date('Y-m-d', time()); ?>"
                 name="start_date" required/>
          <label class="form-label fw-bold">Start Date</label>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <input type="date" class="form-control" min="<?php echo date('Y-m-d', time()); ?>" 
                 name="end_date" required />
          <label class="form-label fw-bold">End date</label>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-success btn-block mb-4">
      Filter
    </button>
  </form>
  <hr/>
</div>
<?php
  if (isset ($_GET['start_date']) && isset ($_GET['end_date'])) {

    $start_date = date('Y-m-d', strtotime ($_GET['start_date']));
    $end_date = date('Y-m-d', strtotime ($_GET['end_date']));
?>
<div class="container p-5">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
     foreach ($keeperList as $keeper) {
       foreach ($_SESSION["loggedUser"]["keepersBetween"] as $date) {
         if ($keeper->getId() == $date->getIdUser()) {
    ?>
    <div class="col">
      <div class="card h-100">
        <img src="<?php echo UPLOADS_PATH . $keeper->getPhoto() ?>" class="card-img-top" alt="avatar" />
          <div class="card-body">
            <h5 class="card-title"><?php echo $keeper->getFullName() ?></h5>
            <p class="card-text">&#127961; <?php echo $keeper->getLiveIn() ?></p>
            <p class="card-text">&#9742; <?php echo $keeper->getPhone() ?></p>
            <p class="card-text">&#128231; <?php echo $keeper->getEmail() ?></p>
            <p class="card-text">&#127968; <?php echo $keeper->getAddress() ?></p>
            <a href="#" class="btn btn-success stretched-link">Make a reservation</a>
          </div>
          <div class="card-footer">
            <?php
            foreach ($dateList as $date) {
              if ($date->getIdUser() == $keeper->getId()) {   
            ?>
                <small class="text-muted">Working from <?php echo $date->getStartDate() ?> to <?php echo $date->getEndDate() ?>.</small>
                
              <?php
              }
            } 
              ?>
          </div>
      </div>
    </div>
    <?php
         }
       }
     }
    ?>
  </div>
</div>
<?php
  }
?>
<!-- ################################################################################################ -->
<?php
include('footer.php');
?>