<?php
include('../controller/dbCon.php');
$id = $_GET['id'];

//Get The Database image name
$usersListQry = mysqli_query($dbCon, "SELECT * FROM users WHERE `id` = '{$id}'");
foreach ($usersListQry as $key => $user) {
$oldImageName = $user['image'];
}

//Delete image
$file = "../image/".$oldImageName;
if (file_exists($file)) {
  unlink($file);
}

//Delete Database table Qry
$deleteUserQry = "DELETE FROM `users` WHERE `id` = {$id}";
$userUpdate = mysqli_query($dbCon, $deleteUserQry);


$message = "Full Delete Success";
header("Location: parDelete.php?msg={$message}");