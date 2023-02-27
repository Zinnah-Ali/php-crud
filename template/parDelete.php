<!doctype html>
<html lang="en">
<head>
  <title>Crud</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
      .login-form{
        width: 600px;
        margin:20px auto;

      }
    </style>
</head>

<body>
<?php
include('../controller/crud.php');
require("../controller/dbCon.php");
$usersListQry = mysqli_query($dbCon, "SELECT * FROM users WHERE `status` = 0");
?>

<div class="container">
  <div class="login-form">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
        <h3 class="text-center">Full Delete Data</h3>
        <a class="btn btn-success my-2" href="../index.php"> Go to List </a>
          <table class="table table-primary">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
                if (isset( $_GET['msg'] )) {
                ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?= $_GET['msg']; ?>
                    </div>
                <?php 
                } 
                // echo "<pre>";
                // echo mysqli_num_rows($usersListQry);
                // die();
                if (mysqli_num_rows($usersListQry) > 0) {
                    foreach ($usersListQry as $key => $user) {
                        ?>
                        <tr class="">
                            <td scope="row"><?= ++$key ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email']?></td>
                            <td>
                            <img style="width:50px; height: 50px;" src="../image/<?= $user['image']?>" alt="">
                            </td>
                            <td>
                            <a class="btn btn-warning" href="../template/active.php?id=<?= $user['id'] ?>"> Active </a>
                            <a class="btn btn-danger" href="../template/fullDelete.php?id=<?= $user['id'] ?>">Full Delete </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<hr> <h3>Data not found</h3>";
                }
                
                  
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
</div>
  



  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
          
  <script>
  var alertList = document.querySelectorAll('.alert');
  alertList.forEach(function (alert) {
    new bootstrap.Alert(alert)
  })
</script>
<script src="./assets/index.js"></script>
</body>

</html>