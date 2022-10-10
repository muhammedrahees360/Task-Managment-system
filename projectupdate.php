<?php
include('dbh.classes.php');

include('controller/vendorController.php');

if (isset($_POST['deleteUser'])) {
    $project_id = $_POST['deleteUser'];
    $user = new vendorController;
    $result = $user->delete($project_id);
    if ($result) {
        header("location: insertuser.php?success=datadeleted");
        exit();
    } else {
        header("location: insertuser.php?error=dataisnotdeleted");
        exit();
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['project_id'];

    $inputData = [

        'vendorname' => $_POST['vendorname'],
        'projectname' => $_POST['projectname'],
        'duedate' => $_POST['duedate'],
        'description' => $_POST['description']
    ];
    $project1 = new vendorController;
    $result = $project1->update($inputData, $id);
    if ($result) {
        header("location: insertuser.php");
    } else {
    }
}
if (isset($_POST["addvendor"])) {

    $username = $_POST['uname'];
    $vendorname = $_POST['vname'];

    $projectname = $_POST['pname'];

    $duedate = $_POST['duedate'];
    $description = $_POST['description'];
    $setuser = new vendorController;

    $result = $setuser->setuser($username, $vendorname, $projectname, $duedate, $description);
}
