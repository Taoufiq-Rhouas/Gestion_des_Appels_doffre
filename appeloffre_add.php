<?php
    include 'conn.php';
    session_start();
    $conn = $pdo->open();

	if(isset($_POST['add'])){

        // Uploade File
        $id_offre_demannde = $_SESSION['id_offre_demannde'];
        $documont = $_POST['fileToUpload'];
        $target_file = $_POST['fileToUpload'];

        
        // $id_offre_demannde = $_SESSION['id_offre_demannde'];
		$nomEntreprise = $_POST['nomEntreprise'];
		$budget = $_POST['budget'];
		$nom_responsable = $_POST['nom_responsable'];
        $email = $_POST['email'];

        // ************** TEST FOR EMAIL IF ALREADY EXIST  *******************
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS emailcount FROM appeloffre WHERE email=:email and id_offre=:id");
		$stmt->execute(['email'=>$email , 'id'=>$id_offre_demannde]);
		$row = $stmt->fetch();

		if($row['emailcount'] > 0){
            $_SESSION['error'] = 'Email already exist for thes offre';
		}
		else{
            if( $id_offre_demannde =="" || $nomEntreprise =="" || $budget =="" || $nom_responsable =="" || $email =="" || $documont ==""){
                $_SESSION['error'] = 'merci de remplir tous les champs';
            }
            else{
                try{
                $stmt = $conn->prepare("INSERT INTO appeloffre (id_offre, nomEntreprise, budget, nom_responsable, email, documont) VALUES (:id_offre, :nomEntreprise, :budget, :nom_responsable, :email, :documont)");
                $stmt->execute(['id_offre'=>$id_offre_demannde, 'nomEntreprise'=>$nomEntreprise, 'budget'=>$budget, 'nom_responsable'=>$nom_responsable , 'email'=>$email, 'documont'=>$documont]);
                $_SESSION['success'] = 'Appel Offre added successfully';
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            }	
		}
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Add info Appel Offre form first';
	}

    // ************** FOR BACK TO PAGE HOME  *******************
	header('location: index.php');

?>