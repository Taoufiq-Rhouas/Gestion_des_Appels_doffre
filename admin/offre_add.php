<?php
    include '../conn.php';
    session_start();
	if(isset($_POST['add'])){
        
		$titre_offre = $_POST['titre_offre'];
		$budget = $_POST['budget'];
		$deadline = $_POST['deadline'];
		$statut = $_POST['statut'];
        $dateExperation = $_POST['dateExperation'];

        $conn = $pdo->open();
        if( $titre_offre =="" || $titre_offre =="" || $budget =="" || $deadline =="" || $statut =="" || $dateExperation ==""){
            $_SESSION['error'] = 'merci de remplir tous les champs';
        }
        else{
            try{
            $stmt = $conn->prepare("INSERT INTO offre (titre_offre, budget, deadline, statut, dateExperation) VALUES (:titre_offre, :budget, :deadline, :statut, :dateExperation)");
            $stmt->execute(['titre_offre'=>$titre_offre, 'budget'=>$budget, 'deadline'=>$deadline, 'statut'=>$statut ,'dateExperation'=>$dateExperation]);
            $_SESSION['success'] = 'Offre added successfully';
            }
            catch(PDOException $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Add info user form first';
	}
	header('location: home.php');

?>