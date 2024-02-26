<?php
session_start();

if (isset($_SESSION["signIn"])) {
  header("Location: ../../DashboardAdmin/dashboardAdmin.php");
  exit;
}

require "../../loginSystem/connect.php";

if (isset($_POST["signIn"])) {

  $nama = strtolower($_POST["nama_admin"]);
  $password = $_POST["password"];

  $result = mysqli_query($connect, "SELECT * FROM admin WHERE nama_admin = '$nama' AND password = '$password' ");
  $data = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) === 1) {
    if ($data['role'] == 'admin') {
      //SET SESSION 
      $_SESSION["signIn"] = true;
      $_SESSION['role'] = $data['role'];
      $_SESSION["admin"]["nama_admin"] = $nama;
      header("Location: ../../DashboardAdmin/dashboardAdmin.php");
      exit;
    } else {
      $error = true;
    }
  }
  $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
   <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
   <title>Sign In || Admin</title>
   <style>
   body {
      background-image: url("../../assets/6761097.jpg");
      background-size: cover;
   }

   .konten {
      margin: 17% auto;
   }
   </style>
</head>

<body>
   <div class="container konten">
      <div class="card p-2 mt-5">
         <div class="position-absolute top-0 start-50 translate-middle">
            <img src="../../assets/adminLogo.png" class="" alt="adminLogo" width="85px" />
         </div>
         <h1 class="pt-5 text-center fw-bold">Sign In</h1>
         <hr />
         <form action="" method="post" class="row g-3 p-4 needs-validation" novalidate>
            <label for="validationCustom01" class="form-label">Nama Lengkap</label>
            <div class="input-group mt-0">
               <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
               <input type="text" class="form-control" name="nama_admin" id="validationCustom01" required />
               <div class="invalid-feedback">Masukkan Nama anda!</div>
            </div>
            <label for="validationCustom02" class="form-label">Password</label>
            <div class="input-group mt-0">
               <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
               <input type="password" class="form-control" id="validationCustom02" name="password" required />
               <div class="invalid-feedback">Masukkan Password anda!</div>
            </div>
            <div class="col-12">
               <button class="btn btn-primary" type="submit" name="signIn">
                  Sign In
               </button>
               <a class="btn btn-success" href="../link_login.html">Batal</a>
            </div>
         </form>
      </div>
      <?php if (isset($error)) : ?>
      <div class="alert alert-danger mt-2" role="alert">
         Nama atau Password Salah!
      </div>
      <?php endif; ?>
   </div>

   <script>
   // Example starter JavaScript for disabling form submissions if there are invalid fields
   (() => {
      "use strict";

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll(".needs-validation");

      // Loop over them and prevent submission
      Array.from(forms).forEach((form) => {
         form.addEventListener(
            "submit",
            (event) => {
               if (!form.checkValidity()) {
                  event.preventDefault();
                  event.stopPropagation();
               }

               form.classList.add("was-validated");
            },
            false
         );
      });
   })();
   </script>
   <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>