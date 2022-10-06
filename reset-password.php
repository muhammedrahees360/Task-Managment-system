<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="padding:4vw ;">
<a  class="btn btn-primary" href="index.php">Back</a>  
    <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="mb-md-5 mt-md-4 pb-5">
                <form action="login.inc.php" method="POST">
                      <h2 class="fw-bold mb-2 text-uppercase">Reset your Password</h2>
                      <p class="text-white-50 mb-5">An email will be send to you with instrunction on how to reset your password</p>
                        <div class="form-outline form-white mb-4">
                            <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg"/>
                            <label class="form-label" for="typeEmailX">Enter your Email</label>
                        </div>
                        </div>
                      <button class="btn btn-outline-light btn-lg px-5" name="reset-request-submit"  type="submit">Submit</button>
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