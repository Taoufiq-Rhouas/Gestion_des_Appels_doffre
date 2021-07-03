
<?php
    include '../conn.php';
    session_start();
    $choix = $_GET['choix'];
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <title>Hello, world!</title>
        <style>
            #btnBack{
                border: none;
                background: #6c62ff;
                padding: 11px 30px;
                font-size: 18px;
                font-weight: 500;
                color: #ffffff !important;
                border-radius: 30px;
                text-decoration: none;
            }

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
                color: #ffffff;
                font-size: 20px;
                font-weight: 500;
                display: inline-block;
                text-align: center;
                padding: 15px 8px;
                padding-left: 20px;
                border-radius: 0px 0px 0px 100px;                
            }

            .textExpirer{
                font-size: 16px;
                font-weight: 700;
                color: #6c62ff;
                text-transform: capitalize;
            }
            .textExpirerRond{
                border-radius: 100px;
                padding: 15px 15px;
                font-size: calc(1.375rem + 1.5vw);
                box-shadow: 0 0 40px #dcdbff;
            }

            .containerExpirer{
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }
            .contentExpirer{
                width: 100%;
                padding: 6% 0px;
                text-align: center;
            }
            .contentExpirer:hover {
                border-bottom: 3px solid #6c62ff;
            }
            .linktextExpirer{
                text-decoration: none;
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
    <?php 
        if($choix == 1){
            echo "<center><h1>panneau de contrôle administrateur : Gestion des Appels D’offre expirer </h1></center>";
        }else{
            echo "<center><h1>panneau de contrôle administrateur : Gestion des Appels D’offre restantes ontre 15 jours ou moins pour expirer</h1></center>";
        }
    ?>
    <hr>
    <br>
    <section>
        <div class="container">
            <!-- ******************* Alert ******************* -->
            <?php
                if(isset($_SESSION['error'])){
                    echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong> Error! </strong> ".$_SESSION['error'].".
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";
                    unset($_SESSION['error']);
                }
                if(isset($_SESSION['success'])){
                    echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong> Success! </strong> ".$_SESSION['success'].".
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";
                    unset($_SESSION['success']);
                }
            ?>
        </div>
    </section>
    <br>
    <section>
        <div class="container">             
            <div class="contentOffre">
                <div class="containerExpirer">
                    <?php 
                        if($choix == 1){
                            echo "
                                <div class='contentExpirer'>
                            ";
                                $conn = $pdo->open();
                                try{
                                    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM `offre` WHERE DATE(`dateExperation`) < DATE(NOW())");
                                    $stmt->execute();
                                    $row = $stmt->fetch();
                                    if($row['numrows'] > 0){
                                        echo "
                                            <a class='linktextExpirer' href='searcheOffre.php?choix=1'>
                                                <center>
                                                    <div>
                                                        <span class='textExpirer textExpirerRond'> " .$row['numrows'] ."</span>
                                                    </div>
                                                </center>
                                                <br>
                                                <span class='textExpirer'> Les offres expirer</span>
                                            </a>
                                        ";
                                    } 
                                }
                                catch(PDOException $e){
                                    echo " There is some problem in connection: " . $e->getMessage();
                                }
                                $pdo->close();
                            echo "
                                </div>
                            ";
                        }else{
                            echo "
                                <div class='contentExpirer'>
                            ";
                                $conn = $pdo->open();
                                try{
                                    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM `offre` WHERE dateExperation < ((DATE(NOW()) + 15)) and  dateExperation > CURRENT_DATE");
                                    $stmt->execute();
                                    $row = $stmt->fetch();
                                    if($row['numrows'] > 0){
                                        echo "
                                            <a class='linktextExpirer' href='searcheOffre.php?choix=1'>
                                                <center>
                                                    <div>
                                                        <span class='textExpirer textExpirerRond'> " .$row['numrows'] ."</span>
                                                    </div>
                                                </center>
                                                <br>
                                                <span class='textExpirer'>Les offres restantes ontre 15 jours ou moins pour expirer</span>
                                            </a>
                                        ";
                                    } 
                                }
                                catch(PDOException $e){
                                    echo " There is some problem in connection: " . $e->getMessage();
                                }
                                $pdo->close();
                            echo "
                                </div>
                            ";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <!-- ******************* Data Offre ******************* -->
    <section>
        <div  class="container">
            <?php
                $conn = $pdo->open();
                try{
                    if($choix == 1){
                        $stmt = $conn->prepare("SELECT * FROM offre WHERE DATE(`dateExperation`) < DATE(NOW())");
                    }else{
                        $stmt = $conn->prepare("SELECT * FROM offre WHERE dateExperation < ((DATE(NOW()) + 15)) and  dateExperation > CURRENT_DATE");
                    }
                    $stmt->execute();
                    foreach($stmt as $row){
                        echo "
                            <div class='contentOffre'>
                                <center><h1 class='titreOffre'>".$row['titre_offre']."</h1></center>
                                <div class='post-date two textIdOffre'>
                                    <span class='IdSpan'>Id: ".$row['id']."</span>
                                </div>
                                <br>
                                <div class='contentOffreInfo'>
                                    <div>
                                        <div>
                                            <h2 class='textInfoOffre'><b>Budget</b> : ".$row['budget']."</h2>
                                        </div>
                                        <div>
                                            <h2 class='textInfoOffre'><b>Didline</b> : ".$row['deadline']."</h2>
                                        </div>
                                    </div>
                                    <div style='float: right;'>
                                        <div>
                                            <h2 class='textInfoOffre'><b>Status</b> : ".$row['statut']."</h2>
                                        </div>
                                        <div>
                                            <h2 class='textInfoOffre'><b>Date experation</b> : ".$row['dateExperation']."</h2>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class='d-grid gap-2 p-5'>
                                    <a class='btn btn-outline-warning' href='#'>appel d'offre</a>
                                </div> -->
                                <div class='container'>
                                    <div class='row'>
                                        <div class='col'>
                                            <div class='d-grid gap-2 p-5'>
                                                <a class='btn btn-outline-warning' href='affiche_appel_offre.php?id=".$row['id']."'>appel d'offre</a>
                                            </div>
                                        </div>
                                        <div class='col'>
                                            <div class='d-grid gap-2 p-5'>
                                                <a class='btn btn-outline-success' href='edit.php?id=".$row['id']."'>Modifier</a>
                                            </div>
                                        </div>
                                        <div class='col'>
                                            <div class='d-grid gap-2 p-5'>
                                                <!--<a class='btn btn-outline-danger' href='delete.php?id=".$row['id']."'>Supprimer</a>-->
                                                <button class='btn btn-outline-danger' onclick='functionAllert(".$row['id'].")' >Supprimer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        ";                  
                    }
                }
                catch(PDOException $e){
                    echo "There is some problem in connection: " . $e->getMessage();
                }
                $pdo->close();
            ?>
            <br>

        </div>
    </section>

    <script>
        // ******************* Confermation Suppresion *******************
        function functionAllert(a){
            var id = a;
            var txt;
            var r = confirm("confirmation !");
            if (r == true) {
                location.href = "delete.php?id="+a;
            } else {
            }
        }
    </script>

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