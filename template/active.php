<?php
include('../controller/dbCon.php');
$id = $_GET['id'];

$deleteUserQry = "UPDATE `users` SET `status`=1 WHERE `id` = {$id}";
$userUpdate = mysqli_query($dbCon, $deleteUserQry);
$message = "Active Success";
header("Location: parDelete.php?msg={$message}");