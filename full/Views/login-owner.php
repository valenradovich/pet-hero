<?php 
    include('header.php');
?>
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
    include('nav-bar-login.php');
?>
<!-- ################################################################################################ -->
<!-- Section: Design Block -->
<div class = "background-home">
  <div class="container p-3">
    <section class=" text-center text-lg-start">
      <style>
        .rounded-t-5 {
          border-top-left-radius: 0.5rem;
          border-top-right-radius: 0.5rem;
        }

        @media (min-width: 992px) {
          .rounded-tr-lg-0 {
            border-top-right-radius: 0;
          }

          .rounded-bl-lg-5 {
            border-bottom-left-radius: 0.5rem;
          }
        }
      </style>
      <div class="card m-5">
        <div class="row g-0 d-flex align-items-center">
          <div class="col-lg-4 d-none d-lg-flex">
            <img src="https://images.pexels.com/photos/7726100/pexels-photo-7726100.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=1" alt=""
              class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
          </div>
          <div class="col-lg-8">
            <div class="card-body py-5 px-md-5">
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in as Owner</h3>
              <form action="<?php echo FRONT_ROOT."owner/login" ?>" method="post">
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" required/>
                  <label class="form-label" for="form2Example1" required >Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" name="password"id="form2Example2" class="form-control" required/>
                  <label class="form-label" for="form2Example2" required>Password</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                  <div class="col">
                    <!-- Simple link -->
                    <p>Don't have an account? <a href="<?php echo FRONT_ROOT."owner/registerview" ?>" class="link-info">Register here</a></p>
                  </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-success btn-block mb-4">Sign in</button>
              </form>
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