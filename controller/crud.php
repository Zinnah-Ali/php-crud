<?php
require('dbCon.php');

//Add users
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

  if (empty($name) || empty($email) || empty($password)) {
      $message = "All Fields are required";
  }else{
    if ($inExtantion == false) {
      $message = " I think Image is some wrong ";
    } else {
      $insertUserQry = "INSERT INTO `users`( `name`, `email`, `password`, `image`) VALUES ('{$name}','{$email}','{$password}', '{$randomFileName}')";
      $userSubmit = mysqli_query($dbCon, $insertUserQry);
  
      if ($userSubmit = true) {
        $message = "User Add Succesfull";
      }else{
        $message = "I think you are wrong";
      }
    }
  }
  header("Location: ../index.php?msg={$message}&name={$name}&email={$email}&pass={$password}");
}



//Update users 
if (isset($_POST['update_users'])) {
  //Get All field
  $id = $_GET['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
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

      //Get The Database image name
      $usersListQry = mysqli_query($dbCon, "SELECT * FROM users WHERE `id` = '{$id}'");
      $oldImageName = '';
      foreach ($usersListQry as $key => $user) {
        $oldImageName = $user['image']; //1677477629.jpg    NewImage.jpg
      }


      if ($fileSize > 0) {
        //Delete old image
          $file = "../image/".$oldImageName;
          if (file_exists($file)) {
            unlink($file);
          }
      }
      
      if ($fileSize > 0) {
        $oldImageName = $randomFileName;
        move_uploaded_file($fileLocation, "../image/".$randomFileName);
      } else {
        $message = "Your Extantion is wrong";
      } 
    }


  if (empty($name) || empty($email) || empty($password)){
      $message = "All Fields are required";
  }else{
    $updateUserQry = "UPDATE `users` SET `name`='{$name}',`email`='{$email}',`password`='{$password}', `image`='{$oldImageName}' WHERE `id` = {$id}";
    $userUpdate = mysqli_query($dbCon, $updateUserQry);

    if ($userUpdate = true) {
      $message = "User Update Succesfull";
    }else{
      $message = "I think you are wrong";
    }
    
  }
  header("Location: ../template/edite.php?msg={$message}&id={$id}");
}
