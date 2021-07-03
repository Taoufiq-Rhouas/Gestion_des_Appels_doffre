<?php
    include '../conn.php';
    session_start();
	if(isset($_POST['edit'])){

        $id = $_SESSION['id_offre_epdate'];
        $titre_offre = $_POST['titre_offre'];
        $budget = $_POST['budget'];
		$deadline = $_POST['deadline'];
		$statut = $_POST['statut'];
        $dateExperation = $_POST['dateExperation'];

        $conn = $pdo->open();

        // ******************* Offre *******************
        $stmt = $conn->prepare("SELECT *, COUNT(*) AS offrecount FROM offre WHERE  `id` =:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($row['offrecount'] > 0){
            try{
                $stmt = $conn->prepare("UPDATE offre SET titre_offre=:titre_offre, budget=:budget, deadline=:deadline, 	statut=:statut, dateExperation=:dateExperation WHERE id=:id");
                $stmt->execute(['titre_offre'=>$titre_offre, 'budget'=>$budget, 'deadline'=>$deadline, 'statut'=>$statut, 'dateExperation'=>$dateExperation, 'id'=>$id]);
                $_SESSION['success'] = 'Offre updated successfully';
            }
            catch(PDOException $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }
        else{
            $_SESSION['error'] = 'Offre not existe';
        }
        
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Add info user form first';
	}
	header('location: home.php');
?>