<?php
include_once('header.php');
?>
<div style=margin-left:3%>
  <header>
    <div>
      <h1 class="nombre-web">
        Cute Paws
      </h1>
    </div>
  </header>
</div>
<!-- NAVBAR HOME ################################################################################################ -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <span class="material-symbols-outlined" size=48px> pets </span>
    </a>
    <div class="collapse navbar-collapse titles-navbar" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item text-center">
          <a class="nav-link active" aria-current="page" href="<?php echo FRONT_ROOT . "Home/Index" ?>" style=color:#198754;>
            <div>
              <span class="material-symbols-outlined">home</span>
            </div>
            Home
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- ################################################################################################ -->
<div class="background-home">
  <div class="container p-3">
    <div class=title-home>
      <h1 class="text-center">¿KEEPER OR OWNER?</h1>
    </div>
    <div class="buttons-home">
      <div class="text-center">
        <a href=<?php echo FRONT_ROOT . "keeper/loginview" ?> class="btn btn-success"> I'm Keeper!
        </a>
        <a href=<?php echo FRONT_ROOT . "owner/loginview" ?> class="btn btn-success">I'm Owner!
        </a>
      </div>
    </div>
  </div>
</div>
<?php
  include_once('footer.php');
?>