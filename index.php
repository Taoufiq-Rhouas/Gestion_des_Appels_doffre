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
            .IdSpanOffre{
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
        <center><h1>Gestion des Appels d’offre</h1></center>
        <br>
        <!-- ******************* Alert ******************* -->
        <div class="container">
            <?php
                
                if(isset($_SESSION['error'])){
                    echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong> Error! </strong> ".$_SESSION['error']."
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";
                    unset($_SESSION['error']);
                }
                if(isset($_SESSION['success'])){
                    echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong> Success! </strong> ".$_SESSION['success']."
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";
                    unset($_SESSION['success']);
                }
            ?>
        </div>
        <!-- ******************* Get Offres ******************* -->
        <section>
            <div class="container">
                <?php
                    $conn = $pdo->open();
                    try{
                        $stmt = $conn->prepare("SELECT * FROM offre");
                        $stmt->execute();
                        foreach($stmt as $row){
                            echo "
                                <div class='contentOffre'>
                                    <center><h1 class='titreOffre'>".$row['titre_offre']."</h1></center>
                                    <div class='post-date two textIdOffre'>
                                        <span class='IdSpanOffre'>Id: ".$row['id']."</span>
                                    </div>
                                    <br>
                                    <div class='contentOffreInfo'>
                                        <div>
                                            <div>
                                                <h2><b>Budget</b> : ".$row['budget']."</h2>
                                            </div>
                                            <div>
                                                <h2><b>Didline</b> : ".$row['deadline']."</h2>
                                            </div>
                                        </div>
                                        <div style='float: right;'>
                                            <div>
                                                <h2><b>Status</b> : ".$row['statut']."</h2>
                                            </div>
                                            <div>
                                                <h2><b>Date experation</b> : ".$row['dateExperation']."</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='d-grid gap-2 p-5'>
                                        <a class='btn btn-outline-warning' href='appelOffre.php?id=".$row['id']."'>Appel D'offre</a>
                                    </div>
                                </div>
                                <br><br>
                            ";                  
                        }
                    }
                    catch(PDOException $e){
                        echo "There is some problem in connection: " . $e->getMessage();
                    }
                    $pdo->close();
                ?>
                <br>
                <br>

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