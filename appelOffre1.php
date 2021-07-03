<?php
    include 'conn.php';
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
            .contentOffre{
                box-shadow: 0 0 40px #dcdbff;
                position: relative;
            }
            .titreOffre{
                color: #6c62ff;
            }
            .textIdOffre{
                position: absolute;
                right: 0;
                top: 0;
            }
            .contentOffreInfo{
                display: flex;
                justify-content: space-between;
                padding: 0px 20px;
            }
            .textInfoOffre{
                /* font-size: 20px; */
            }

            .IdSpan{
                background: #fe6566;
                /* width: 100px;
                height: 90px; */
                /* background: #7167ff; */
                color: #ffffff;
                font-size: 20px;
                font-weight: 500;
                display: inline-block;
                text-align: center;
                padding: 15px 8px;
                padding-left: 20px;
                border-radius: 0px 0px 0px 100px;
                /* transition: all 0.5s; */
                
            }

            /*  */
            .contentOffreAppelInfo{
                box-shadow: 0 0 40px #dcdbff;
                position: relative;
                padding: 20px;
            }

            /* button submit */
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
                /* width: 80%; */
            
            }
            /* button submit */
        </style>
    </head>
    <body>
        <!-- ******************* NavBar ******************* -->
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
                    <a class="btn btn-outline-success" href="login.php">Connexion</a>
                </form>
            </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                <a id="btnBack" href="index.php">retourner</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex">
                <!-- <button class="btn btn-outline-success" type="submit">Login</button> -->
                </form>
            </div>
            </div>
        </nav>
        <center><h1>Gestion des Appels d’offre</h1></center>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-8">
                    <!-- ******************* Alert ******************* -->
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
                </div>
                <div class="col-2">
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <!-- ******************* Get Offre ******************* -->
                <?php
                    $conn = $pdo->open();
                    $id = $_GET['id'];
                    $_SESSION['id_offre_demannde'] = $id;
                    try{
                                 
                        $stmt = $conn->prepare("SELECT *  FROM offre WHERE id = :id");
                        $stmt->execute(['id' => $id]);
                        $offre = $stmt->fetch();
                        
                    }
                    catch(PDOException $e){
                        echo "There is some problem in connection: " . $e->getMessage();
                    }
                ?>
                <div class="contentOffre">
                    <center><h1 class="titreOffre"><?php echo $offre['titre_offre']; ?></h1></center>
                    <div class="post-date two textIdOffre">
                        <span class="IdSpan">Id: <?php echo $offre['id']; ?></span>
                    </div>
                    <br>
                    <div class="contentOffreInfo">
                        <div>
                            <div>
                                <h2><b>Budget</b> : <?php echo $offre['budget']; ?></h2>
                            </div>
                            <div>
                                <h2><b>Didline</b> : <?php echo $offre['deadline']; ?></h2>
                            </div>
                        </div>
                        <div style="float: right;">
                            <div>
                                <h2><b>Status</b> : <?php echo $offre['statut']; ?></h2>
                            </div>
                            <div>
                                <h2><b>Date experation</b> : <?php echo $offre['dateExperation']; ?></h2>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                </div>
                <br>
            </div>
        </section>
        <br>
        <!--  -->
        <section>
        <div class="container">
            <div class="contentOffreAppelInfo" >
                <!-- form -->
                <form method="POST" action="appeloffre_add.php">
                    <div class="mb-3">
                      <label for="nomEntreprise" class="form-label">Nom Entreprise : </label>
                      <input type="text" class="form-control" id="nomEntreprise" name="nomEntreprise" required>
                      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="budget" class="form-label">Budget (DH) : </label>
                        <input type="number" class="form-control" id="budget" name="budget" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom_responsable" class="form-label">Nom Responsable : </label>
                        <input type="text" class="form-control" id="nom_responsable" name="nom_responsable" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email : </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="fileToUpload" class="form-label">Documont : </label>
                        <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" required>
                    </div>
                    <div class=""  >
                        <center><button type="submit" class="primary-btn" id="btnSubmit" name="add">Enregistrer</button></center>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <br>

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