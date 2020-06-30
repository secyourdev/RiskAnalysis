<?php
//Connexion à la base de donnee
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v11");
$query = $connect->prepare("SELECT * FROM niveau NATURAL JOIN echelle WHERE id_echelle = ?");
// $query = "SELECT * FROM niveau NATURAL JOIN echelle";
// $result = mysqli_query($connect, $query);

if(isset($_POST['nom_echelle'])){
    $nom_echelle = $_POST['nom_echelle'];
    echo $nom_echelle;
    $id_echelle = $connect->prepare("SELECT id_echelle FROM echelle WHERE nom_echelle = ?");
    $id_echelle->bind_param("s", $nom_echelle);
    $id_echelle->execute();
    $resultat = $id_echelle->fetch();
    echo "id_echelle"."\n";
    print_r($id_echelle);
    echo "resultat";
    print_r($resultat);


    // $row = mysqli_fetch_array($result);
    // print_r($row);
    // $query->execute();
    // $row = $query->fetch();
    // print_r($row);
    $query->bind_param("i", $resultat);
    $result = $query->execute();
    while($row = mysqli_fetch_array($result))
    {
      echo '
      <tr>
      <td>'.$row["id_niveau"].'</td>
      <td>'.$row["valeur_niveau"].'</td>
      <td>'.$row["description_niveau"].'</td>
      </tr>
      ';
    }
    // while($row){echo "lol";}
}


?>