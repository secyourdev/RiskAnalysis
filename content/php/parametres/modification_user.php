<?php
  session_start();
  $getid_utilisateur = $_SESSION['id_utilisateur'];

  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v14;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

  $results["error"] = false;
  $results["message"] = [];

  $poste=$_POST['poste'];
  $email=$_POST['email'];

  $updateutilisateur = $bdd->prepare('UPDATE utilisateur SET poste = ?, email = ? WHERE id_utilisateur = ?');

    // Verification du poste
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
      $results["error"] = true;
      $results["message"]["poste"] = "Poste invalide";
      ?>
      <strong style="color:#FF6565;">Poste invalide </br></strong>
      <?php
    }

    // Verification du email
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s.,-@]{1,100}$/", $email)){
        $results["error"] = true;
        $results["message"]["email"] = "E-mail invalide";
        ?>
        <strong style="color:#FF6565;">E-mail invalide </br></strong>
        <?php
    }

    if ($results["error"] === false && isset($_POST['modifier_user'])){
        $updateutilisateur->bindParam(1, $poste);
        $updateutilisateur->bindParam(2, $email);
        $updateutilisateur->bindParam(3, $getid_utilisateur);
        $updateutilisateur->execute();

        header('Location: ../../../parametres&'.$_SESSION['id_utilisateur']);
        ?>
        <strong style="color:#4AD991;">La personne a bien été modifiée !</br></strong>
        <?php
    }  
?>