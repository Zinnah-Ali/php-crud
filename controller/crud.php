<?php
require('dbCon.php');
if (isset($_POST['save_users'])) {

  //Image upload system 
  $imageArry = $_FILES['image'];
  if (isset($imageArry)) {
    $fileName = $imageArry['name'];
    $fileLocation = $imageArry['tmp_name'];
    $fileSize = $imageArry['size'];
    $fileExtantionArry = explode(".", $fileName);
    $fileExtantion = strtolower(end($fileExtantionArry));
    $valideExtantion = ["jpg", "png", "jpeg"];
    $inExtantion = in_array($fileExtantion, $valideExtantion);

    $randomFileName = time().$fileName;
    $imageStatus = false;
    if ($inExtantion == true) {
      move_uploaded_file($fileLocation, "../image/".$randomFileName);
      $imageStatus  = true;
    } else {
      $message = "Your Extantion is wrong";
    }
    
  }

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($name) || empty($email) || empty($password) || $inExtantion == false) {
      $message = "All Fields are required";
  }else{
    $insertUserQry = "INSERT INTO `users`( `name`, `email`, `password`, `image`) VALUES ('{$name}','{$email}','{$password}', '{$randomFileName}')";
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

    //Image upload system 
    $imageArry = $_FILES['image'];
    if (isset($imageArry)) {
      $fileName = $imageArry['name'];
      $fileLocation = $imageArry['tmp_name'];
      $fileSize = $imageArry['size'];
      $fileExtantionArry = explode(".", $fileName);
      $fileExtantion = strtolower(end($fileExtantionArry));
      $valideExtantion = ["jpg", "png", "jpeg"];
      $inExtantion = in_array($fileExtantion, $valideExtantion);
  
      $randomFileName = time().$fileName;
      $imageStatus = false;
      if ($inExtantion == true) {
        move_uploaded_file($fileLocation, "../image/".$randomFileName);
        $imageStatus  = true;
      } else {
        $message = "Your Extantion is wrong";
      }
      
    }

  $id = $_GET['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($name) || empty($email) || empty($password) ) {
      $message = "All Fields are required";
  }else{
    if ($imageStatus == false) {
      $message = "please Add One Image File This page the field is requarde";
    } else {
      $updateUserQry = "UPDATE `users` SET `name`='{$name}',`email`='{$email}',`password`='{$password}', `image`='{$randomFileName}' WHERE `id` = {$id}";
      $userUpdate = mysqli_query($dbCon, $updateUserQry);

      if ($userUpdate = true) {
        $message = "User Update Succesfull";
      }else{
        $message = "I think you are wrong";
      }
    }
  }
  header("Location: ../template/edite.php?msg={$message}&id={$id}");
}

