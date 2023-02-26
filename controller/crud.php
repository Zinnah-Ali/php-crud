<?php
require('dbCon.php');
if (isset($_POST['save_users'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($password)) {
        $message = "All Fields are required";
    }else{
      $insertUserQry = "INSERT INTO `users`( `name`, `email`, `password`) VALUES ('{$name}','{$email}','{$password}')";
      $userSubmit = mysqli_query($dbCon, $insertUserQry);

      if ($userSubmit = true) {
        $message = "User Add Succesfull";
      }else{
        $message = "I think you are wrong";
      }
    }
    header("Location: ../index.php?msg={$message}");
}

if (isset($_POST['update_users'])) {
  $id = $_GET['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($name == '' || $email == '' || $password == '') {
      echo "All Fields are required";
  }else{
    $updateUserQry = "UPDATE `users` SET `name`='{$name}',`email`='{$email}',`password`='{$password}' WHERE `id` = {$id}";
    $userUpdate = mysqli_query($dbCon, $updateUserQry);

    if ($userUpdate = true) {
      $message = "User Update Succesfull";
    }else{
      $message = "I think you are wrong";
    }
    header("Location: ../template/edite.php?msg={$message}&id={$id}");
  }
}

