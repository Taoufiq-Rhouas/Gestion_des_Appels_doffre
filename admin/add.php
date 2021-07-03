<?php
    include '../conn.php';
    session_start();
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Hello, world!</title>
        <style>
            #btnBack{
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
            .contentOffreAppelInfo{
                box-shadow: 0 0 40px #dcdbff;
                position: relative;
                padding: 20px;
            }
            #btnSubmit{
                border: none;
                /* display: inline-block; */
                background: #6c62ff;
                padding: 11px 30px;
                font-size: 18px;
                font-weight: 500;
                color: #ffffff !important;
                border-radius: 30px;
                width: 80%;
            }
        </style>
    </head>
    <body>
    <!-- ******************* NavBar  ******************* -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">Gestion Des Appels</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex">
                    <a class="btn btn-outline-success" href="../logout.php">Déconnexion</a>
                </form>
            </div>
            </div>
        </nav>
        <br>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a id="btnBack" href="home.php">retourner</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
            </div>
            </div>
        </nav>
        <center><h1>panneau de contrôle administrateur : Gestion Des Appels D'offre</h1></center>
        <hr>
        <br>
        <section>
            <div class="container">
                <!-- ******************* Alert  ******************* -->
                <?php
                    if(isset($_SESSION['error'])){
                        echo "
                        <div class='alert alert-danger alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-warning'></i> Error!</h4>
                            ".$_SESSION['error']."
                        </div>
                        ";
                        unset($_SESSION['error']);
                    }
                    if(isset($_SESSION['success'])){
                        echo "
                        <div class='alert alert-success alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check'></i> Success!</h4>
                            ".$_SESSION['success']."
                        </div>
                        ";
                        unset($_SESSION['success']);
                    }
                ?>
                <div class="contentOffreAppelInfo" >
                    <!-- form -->
                    <form method="POST" action="offre_add.php">
                        <div class="mb-3">
                            <label for="titre_offre" class="form-label">Titre Offre : </label>
                            <input type="text" class="form-control" id="titre_offre" name="titre_offre"  required>
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-3">
                            <label for="Budget" class="form-label">Budget (DH) : </label>
                            <input type="number" class="form-control" id="budget" name="budget" required>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline : </label>
                            <input type="date" class="form-control" id="deadline" name="deadline" required>
                        </div>
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut : </label>
                            <input type="text" class="form-control" id="statut" name="statut"  required>
                        </div>
                        <div class="mb-3">
                            <label for="dateExperation" class="form-label">Date Experation : </label>
                            <input type="date" class="form-control" id="dateExperation" name="dateExperation" required>
                        </div>
                        <div class=""  >
                            <center><button type="submit" class="primary-btn" id="btnSubmit" name="add">Enregistrer</button></center>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <br>
        <?php $pdo->close(); ?>

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