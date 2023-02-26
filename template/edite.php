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
$id = $_GET['id'];
$usersListQry = mysqli_query($dbCon, "SELECT * FROM users WHERE `id` = {$id}");


?>

<div class="container">
  <div class="login-form">
    <div class="card">
      <div class="card-body">
        <h3 class="text-center">Users Info</h3>
        <a class="btn btn-success my-2" href="../index.php"> go to list </a>
        <?php
            if (isset($_GET['msg'])) { ?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?= $_GET['msg']; ?>
                </div>
        <?php } ?>
        <?php foreach ($usersListQry as $key => $user) { ?>
            <form action="../controller/crud.php?id=<?php echo $user['id'] ?>" method="POST">
                <div class="mb-3">
                    <input type="name" class="form-control" name="name" id="name"
                    placeholder="Name" value="<?= $user['name']; ?>">
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" name="email" id="email"
                    placeholder="abc@mail.com"  value="<?= $user['email']; ?>">
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="password" id="password" placeholder=""  value="<?= $user['password']; ?>">
                </div>
                <div class="mb-3 text-center">
                    <input type="submit" value="Change Data" class="btn btn-success" name="update_users" id="submit">
                </div>
            </form>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="login-form">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-primary">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($usersListQry as $key => $user) {
                ?>
                <tr class="">
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email']?></td>
                    <td>
                    <a class="btn btn-info" href="edit.php"> Edit </a>
                    <a class="btn btn-danger" href="delete.php"> Delete </a>
                    </td>
                </tr>
                <?php }?>
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
</body>

</html>