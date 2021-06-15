<?php
try{
    //Serveur Distant
     $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v29;charset=utf8','ebios-rm_admin','2HW8RYULUtnjkCD0pRtngaigq9J0');
    //Serveur Local
    //$bdd=new PDO('mysql:host=localhost;dbname=bdd;charset=utf8','root','',
    //array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
}

?>