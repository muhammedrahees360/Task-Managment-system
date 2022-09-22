<?php
session_start();
include 'login.inc.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
 
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
              <form action="login.inc.php" method="POST">
              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="text" id="typeEmailX" name="uid" class="form-control form-control-lg"  value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>"/>
                <label class="form-label" for="typeEmailX">Username</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" name="pwd" class="form-control form-control-lg" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>"/>
                <label class="form-label" for="typePasswordX">Password</label>
              </div>
              <div class="form-check d-flex justify-content-start mb-4">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" name="remember"  <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>/>
              <label class="form-check-label" for="form1Example3"> Remember password </label>
              </div>
              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="reset-password.php">Forgot password?</a></p>

              <button class="btn btn-outline-light btn-lg px-5" name="submit"  type="submit">Login</button>
</form>
             

            </div>

           

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
