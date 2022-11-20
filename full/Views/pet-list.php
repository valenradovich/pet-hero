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
            <p class="text-muted mb-0"><?php echo $pet->getPetTypeString()?> <?php echo $pet->getBreedString() ?></p>
            <p class="text-muted mb-0">&#128207;<?php echo $pet->getSizeString()?></p>
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