<?php
session_start();
include 'header.admin.php';
echo "<br>";
echo "<br>";
echo "<br>";
include "dbh.classes.php";
include "controller/vendorController.php";
if (isset($_GET["error"])) {

  if ($_GET["error"] == 'stmtfailed') {
    echo "<p>Something went wrong,try again</p>";
  } elseif ($_GET["error"] == 'none') {
    echo "<p style='color:green;'>Login Successful</p>";
  } elseif ($_GET["error"] == 'dataisnotdeleted') {
    echo "<p style='color:red;'>Data is not Deleted</p>";
  } elseif ($_GET["error"] == 'userinvalid') {
    echo "<p>Data is not Deleted</p>";
  }
}
if (isset($_GET["success"])) {
  if ($_GET["success"] == 'datadeleted') {
    echo "<center><p style='color:green;'>Data is Deleted</p></center>";
  } elseif ($_GET["success"] == 'userisadded') {
    echo "<center><p>Vendor added successfully</p></center>";
  }elseif ($_GET["success"] == 'valueupdated') {
    echo "<center><p style='color:green;'>Value Updated</p></center>";
  }elseif ($_GET["success"] == 'vendoradded') {
    echo "<center><p style='color:green;'>Vendor Added</p></center>";
  }
}

if (isset($_SESSION['useruid'])) {
  if (isset($_POST["submit"])) {
    $id = 1;
    $user = new vendorController();
    $user->insertuser($id);
  }
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>

  <body style="padding: 4vw;">
    <h1 style="width: max-content;padding: 10px;margin: 10px;"> Welcome <?= $_SESSION['useruid'] ?></h1>
    <h3>
      <center>Vendor List</center>
    </h3>
    <form action="addvendor.php" method="POST">
      <button type="submit" class="btn btn btn-primary" style="float: right;margin-right: 10px;padding: 5px;margin-bottom:6px;">+Add Vendor</button>
    </form>
    <!-- <form action="addUserview.php" method="POST">
        <button type="submit" name="deleteUser" class="btn btn btn-primary" style="float: right;margin-right: 10px;padding: 5px;" value="<?= $row["user_id"] ?>" >+Add User</button>
        </form>  -->
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th> ID </th>
          <th>Vendor Name</th>
          <th>Project Name</th>
          <th>Project Manager</th>
          <th>Email</th>
          <th></th>
          <th></th>
          <th>
          <th>
        </tr>
      </thead>
      <tbody>
        <?php
        $student = new vendorController;

        $result = $student->index();
        if ($result) {
          foreach ($result as $row) {
            $select = "email";
            $select_fullname = 'full_name';
            $value = 'user_id';
            $uid = $row['users_id'];
            $user_email = $student->getuser($uid, $value, $select);
            $user_fullname = $student->getuser($uid, $value, $select_fullname);


        ?>
            <tr>
              <td><?= $row["project_id"] ?></td>
              <td><?= $row["vendor_name"] ?></td>
              <td> <?= $row["project_name"] ?> </td>
              <td> <?= $user_fullname[0]['full_name'] ?> </td>
              <td> <?= $user_email[0]['email'] ?> </td>
              <td><a href="projectlist-edit.php?id=<?= $row["project_id"] ?>" class="btn btn-success">Edit</a> </td>
              <td>
                <form action="projectupdate.php" method="POST">
                  <button type="button" name="deleteUser" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger" value="<?= $row["project_id"] ?>">Delete</button>
                </form>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                      </div>
                      <div class="modal-footer">
                        <form action="projectupdate.php" method="POST">

                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger" name="deleteUser" value="<?= $row["project_id"] ?>">Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <td>
                <form action="taskdisp.php" method="POST">
                  <input type="hidden" name="user_email" value="<?= $user_email[0]['email'] ?>">
                  <input type="hidden" name="full_name" value="<?= $user_fullname[0]['full_name'] ?>">
                  <button type="submit" name="viewproject" class="btn btn-success" value="<?= $row["project_id"] ?>">View</button>
                </form>
              </td>
            </tr>
        <?php
          }
        }

        ?>
        <?php
        $uid = $row["users_id"];

        $studentgetuser = new vendorController;
        $value = 'user_id';
        $select = 'user_name';
        $getuser = $studentgetuser->getuser($uid, $value, $select);
        if ($getuser) {
        }

        ?>

      </tbody>
    </table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

  </html>
<?php
} else {
  header("location:index.php");
}

?>