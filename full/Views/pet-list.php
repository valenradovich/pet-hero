<?php 
 include('header.php');
 include('nav-bar-owner.php');
?>
<!-- ################################################################################################ -->
<div class="container p-5" >
  <form action="<?php echo FRONT_ROOT."pet/remove" ?>" method="post">
    <ul class="list-group list-group-light">
      <?php
        foreach($petList as $pet) {
          if ($pet->getIdOwner() == $_SESSION['loggedUser']["id"]) { ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
          <img src="<?php echo UPLOADS_PATH.$pet->getPhoto()?>" alt="" style="width: 45px; height: 45px"
            class="rounded-circle" />
          <div class="ms-3">
            <p class="fw-bold mb-1"><?php echo $pet->getName() ?></p>
            <p class="text-muted mb-0"><?php echo $pet->getPetTypeString() ?></p>
            <p class="text-muted mb-0"></p>
            <p class="text-muted mb-0">&#128209; <?php echo $pet->getDescription() ?></p>
          </div>
        </div>
        <button type="submit" name="id_pet" class="btn btn-dark" value="<?php echo $pet->getId() ?>"> Remove </button>
      </li>
      <?php
          }
        }
      ?> 
    </ul>
  </form>
</div>
<!-- ################################################################################################ -->
<!--<div class="wrapper row4">
  <main class="hoc container clear"> 
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT."Pet/Remove" ?>" method="">
        <table style="text-align:center;">
          <thead>
            <tr style="max-width: 100px;">
              <th style="width: 15%;">Name</th>
              <th style="width: 15%;">Breed</th>
              <th style="width: 10%;">Size</th>
              <th style="width: 10%;">Vaccines</th>
              <th style="width: 10%;">Photo</th>
              <th style="width: 30%;">Description</th>
              <th style="width: 10%;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($petList as $pet) {
                if ($pet->getIdOwner() == $_SESSION['loggedUser']["id"]) {
                ?>
                  <tr>
                    <td><?php echo $pet->getName() ?></td>
                    <td><?php echo $pet->getBreed() ?></td>
                    <td><?php echo $pet->getSize() ?></td>
                    <td><?php echo $pet->getVaccines() ?></td>
                    <td><?php echo $pet->getPhoto() ?></td>
                    <td><?php echo $pet->getDescription() ?></td>
                    <td>
                      <button type="submit" name="id" class="btn" value="<?php echo $pet->getId() ?>"> Remove </button>
                    </td>
                  </tr>
                <?php
                }
              }
            ?>                          
          </tbody>
        </table></form> 
      </div>
    </div>
    <div class="clear"></div>
  </main>
</div>
-->

<?php 
  include('footer.php');
?>