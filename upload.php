<?php
    include 'conn.php';
    session_start();


$id_offre_demannde = $_SESSION['id_offre_demannde'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$newnameFale = "";

// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists,change name .";
  header('location: history.back()');
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF PDF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    $_SESSION['error'] = 'Sorry, your file was not uploaded.Change Name Fille';
    header('location: appelOffre.php?id='.$id_offre_demannde.'');
    
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $newnameFale = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
        // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        echo "The file ".$newnameFale. " has been uploaded.";


        // save data in database

        
        $conn = $pdo->open();

        if(isset($_POST['add'])){

            // Uploade File
            // $id_offre_demannde = $_SESSION['id_offre_demannde'];
            $documont = $newnameFale;
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

        // end data













  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>