<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: user/home.php');
    
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Document</title>

    <link rel="stylesheet" href="includes/style/style_login.css">
  <style>
    #btnSignin{
      border: none;
      /* display: inline-block; */
      background: #6c62ff;
      padding: 11px 30px;
      font-size: 18px;
      font-weight: 500;
      color: #ffffff !important;
      border-radius: 30px;
      text-decoration: none;
    }

    @media screen and (max-width: 600px) {
    .formBx {
      width: 100% !important;
    }
    .imgBx {
      width: 0% !important;
    }
  }
  </style>
</head>
<body class="hold-transition login-page">
  <section id="section1">
    <div class="container">
      <div class="user singinBx">
        <div class="imgBx"><img src="includes/images/img2.jpg"></div>
        <div class="formBx">
          <form  action="verify.php" method="POST" style="width: 100%;">
            <span>
              <?php
                if(isset($_SESSION['error'])){
                  echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>Error !</strong> ".$_SESSION['error'].".
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>

                  ";
                  unset($_SESSION['error']);
                }
                if(isset($_SESSION['success'])){
                  echo "
                    <div class='callout callout-success text-center'>
                      <p>".$_SESSION['success']."</p> 
                    </div>
                  ";
                  unset($_SESSION['success']);
                }
              ?>
            </span>
            <h2 class="login-box-msg">Connexion</h2>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <span class=""></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <button type="submit" class="" name="login" id="btnSignin"><i class="fa fa-sign-in"></i>Connexion</button>
            <a href="index.php"><i class="fa fa-home"></i>accueil</a>
          </form>
        </div>
      </div>
    </div>
  </section>

<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</html>