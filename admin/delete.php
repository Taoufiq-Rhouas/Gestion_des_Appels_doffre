<?php
    include '../conn.php';
	session_start();
		$id = $_GET['id'];
		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("DELETE FROM appeloffre WHERE id_offre=:id");
			$stmt->execute(['id'=>$id]);

			$stmt = $conn->prepare("DELETE FROM offre WHERE id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'offre deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		$pdo->close();
	header('location: home.php');
	
?>