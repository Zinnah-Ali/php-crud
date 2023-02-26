<?php
include('../controller/dbCon.php');
$id = $_GET['id'];

$deleteUserQry = "UPDATE `users` SET `status`=0 WHERE `id` = {$id}";
$userUpdate = mysqli_query($dbCon, $deleteUserQry);
$message = "Delete Success";
header("Location: ../index.php?msg={$message}");

