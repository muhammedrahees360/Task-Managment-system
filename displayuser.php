<?php
session_start();
include('dbh.classes.php');
include "controller/userController.php";
if (isset($_SESSION['useruid'])) {
    include 'header.admin.php';
    echo "<brinclude('dbconn.php');>";
    echo "<br>";
    echo "<br>";
    if (isset($_GET["success"])) {
        if ($_GET["success"] == 'useradded') {
            echo "<p style='color:green;'>User  added sucesssfully</p>";
        } elseif ($_GET["success"] == 'userisadded') {
            echo "<p style='color:green;'>Vendor added successfully</p>";
        }elseif ($_GET["success"] == 'valueupdated') {
            echo "<p style='color:green;'>Value is successfully updated</p>";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>


    </head>

    <body style="padding: 4vw;">
        <a class="btn btn-dark" href="insertuser.php">Back</a>
        <h2>
            <center>Users List</center>
            <hr>
        </h2>
        <form style="float:right;padding:5px" action="addUserview.php" method="POST">
            <button type="submit" class="btn btn-primary" value="<?= $row["user_id"] ?>">+Add User</button>
        </form>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th> User Id </th>
                    <th>User Name</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>User role</th>
                    <th>Last Login</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $student = new userContr;
                $user_role = $_SESSION['user_role'];

                $result = $student->index();
                $size = sizeof($result);
                for ($i = 0; $i < $size; $i++) {
                    if ($result[$i]['user_role'] == 1) {
                        $total_role++;
                    }
                }
                if ($result) {
                    foreach ($result as $row) {
                ?>
                        <tr>
                            <td class="userid" value="<?= $row['user_id'] ?>"><?= $row["user_id"] ?></td>
                            <td><?= $row["user_name"] ?></td>
                            <td><?= $row["full_name"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td><?= ($row["user_role"] == 1 ? 'Admin' : 'projectmanager'); ?> </td>
                            <td><?= $row["updated_at"] ?></td>
                            <td>
                                <a href="edituserview.php?id=<?= $row["user_id"] ?>" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <?php
                                if ($row["user_role"] == 2 || $total_role > 1) {
                                ?>
                                    <!-- adduser.model.php -->
                               
                                        <button type="button" name='deleteUser' class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" value="<?= $row['user_id'] ?>" >Delete</button>
                                        <?= $row['user_id'] ?>
                                    <!-- Modal -->
                                    
                             
                                <?php
                                }

                                ?>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "No record found";
                }
                ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('.delete_btn').click(function(e) {
                    e.preventDefault();

                    var id = $(this).closest('tr').find('.userid').text();
                    console.log(id);
                    $('#deleteStudentModel').modal('show');
                });
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  value="<?= $row['user_id'] ?>">
            <?= $row['user_id'] ?>    
            <div class="modal-dialog" role="document">

                    <div class="modal-content">
                    
                        <div class="modal-header">
                        
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this record <?= $row['user_id'] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <?= $row['user_id'] ?>
                        </div>
                        <div class="modal-footer">
                            <form action="adduser.model.php" method="POST">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger" name="deleteUser" value="<?= $row['user_id'] ?>">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </body>

    </html>
<?php
} else {
    header("location:index.php");
}

?>