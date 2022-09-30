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
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Reset your Password</h1>
            <p>An email will be send to you with instrunction on how to reset your password</p>
            <form action="login.inc.php" method="POST">
                <input type="email" class="form-control" name="email" placeholder="Enter your email address">
                <button type="submit" class="btn btn-lg btn-primary"  name="reset-request-submit">Submit</button>       
            </form>
        </section>
    </div>
</body>
</html>