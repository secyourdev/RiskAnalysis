<?php
try{
    //Serveur Distant
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v28;charset=utf8','ebios-rm_admin','hLLFL\bsF|&[8=m8q-$j',
    //Serveur Local
    //$bdd=new PDO('mysql:host=localhost;dbname=ebios-rm_v22;charset=utf8','root','',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
}

?>