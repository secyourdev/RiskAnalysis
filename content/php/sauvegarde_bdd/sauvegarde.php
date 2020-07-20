<?php
//Entrez ici les informations de votre base de données et le nom du fichier de sauvegarde.
$mysqlDatabaseName ='ebios-rm_v5';
$mysqlUserName ='root';
$mysqlPassword ='';
$mysqlHostName ='localhost';
$mysqlExportPath ='nom-du-fichier-dexport.sql';

//Veuillez ne pas modifier les points suivants
//Exportation de la base de données et résultat
$command='mysqldump --opt --host=' .$mysqlHostName .' --user=' .$mysqlUserName .' --password="' .$mysqlPassword .'" --databases' .$mysqlDatabaseName .' > ' .$mysqlExportPath;
$output=array();
exec($command,$output,$worked);
switch($worked){
case 0:
echo 'La base de données <b>' .$mysqlDatabaseName .'</b> a été stockée avec succès dans le chemin suivant '.getcwd().'/' .$mysqlExportPath .'</b>';
break;
case 1:
echo 'Une erreur s est produite lors de la exportation de <b>' .$mysqlDatabaseName .'</b> vers '.getcwd().'/' .$mysqlExportPath .'</b>';
break;
case 2:
echo 'Une erreur d exportation s est produite, veuillez vérifier les informations suivantes : <br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
break;
}
?>