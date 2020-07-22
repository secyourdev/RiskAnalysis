# CyberRiskManager, Copyright 2020 ©
## 1/Téléchargez le repository SecYourDev/CyberRiskManager en le sauvegardant momentanément dans un dossier temporaire

## 2/Lancez l'installation d'un serveur Apache, de préférence Xampp

## 3/Mettez le dossier téléchargé dans le dossier C:\xampp\htdocs\

## 4/Configuez l'arrivée de mail depuis de notre application :
En modifiant le fichier ```C:\xampp\php\php.ini``` en changeant les lignes de la fonction ```[mail function]``` par :

```[mail function]
; For Win32 only.
; http://php.net/smtp
;SMTP=(smtp-ebios-rm.alwaysdata.net) #/!\ Ceci est un exemple, vous devez mettre votre serveur SMTP !
; http://php.net/smtp-port
;smtp_port=587 #/!\ Ceci est un exemple, vous devez mettre votre serveur SMTP !

; For Win32 only.
; http://php.net/sendmail-from
;sendmail_from =
; For Unix only.  You may supply arguments as well (default: "sendmail -t -i").
; http://php.net/sendmail-path
sendmail_path = ""C:\xampp\sendmail\sendmail.exe" -t"

; Force the addition of the specified parameters to be passed as extra parameters
; to the sendmail binary. These parameters will always replace the value of
; the 5th parameter to mail().
;mail.force_extra_parameters =

; Add X-PHP-Originating-Script: that will include uid of the script followed by the filename
;mail.add_x_header=Off

; The path to a log file that will log all mail() calls. Log entries include
; the full path of the script, line number, To address and headers.
;mail.log =
; Log mail to syslog
```
Ensuite, vous devez modifier le fichier ```C:\xampp\sendmail\sendmail.ini``` en supprimant tout et en remplaçant par :

```[sendmail]

smtp_server=smtp-ebios-rm.alwaysdata.net #/!\ Ceci est un exemple, vous devez mettre votre serveur SMTP !
smtp_port=587 #/!\ Ceci est un exemple, vous devez mettre votre serveur SMTP !
smtp_ssl=auto
error_logfile=error.log
debug_logfile=debug.log
auth_username=ebios-rm@alwaysdata.net #/!\ Ceci est un exemple, vous devez mettre votre serveur SMTP !
auth_password=hLLFL\bsF|&[8=m8q-$j #/!\ Ceci est un exemple, vous devez mettre votre serveur SMTP !
force_sender=ebios-rm@alwaysdata.net #/!\ Ceci est un exemple, vous devez mettre votre serveur SMTP !
```

## 5/Créez une base de données dans phpmyadmin avec le nom que vous désirez !

## 6/Importez le fichier base_de_donnees.sql dans phpmyadmin et dans la base de données que vous venez de créer. 
Pour effectuer l'import, vous avez juste à vous rendre sur la base de données et dans l'onglet 'Import' pour déposer le fichier SQL. 

## 7/Modifiez les fichiers de configuration de la base de donnée pour effectuer la connexion depuis l'application : 
Dans le fichier ```content/php/bdd/connexion.php``` : 
Appliquer sur la ligne ```$bdd=new PDO(...)``` les données pour effectuer la connexion : /!\ Attention, l'ordre est celle que nous avons précisé ! /!\
``` HOST : "localhost" 
	DBNAME : "Nom de la table donnée précédemment"
	CHARSET : "utf8"
	ID : "root"
	PASSWORD : ""
```
Dans le fichier ```content/php/bdd/connexion_sqli.php``` : 
Appliquer sur la ligne ```$connect = mysqli_connect(...)``` les données pour effectuer la connexion : /!\ Attention, l'ordre est celle que nous avons précisé ! /!\
``` HOST : "localhost" 
	ID : "root"
	PASSWORD : ""
	DBNAME : "Nom de la table donnée précédemment"
```
## 8/Mettez en place la sauvegarde
Vous aurez besoin juste d'indiquer les données de connexion : 
```	'username' => 'root',
	'passwd' => '',
	'dbname' => 'Nom de la table donnée précédemment',
	'host' => 'localhost',
```
## 9/Vous pourrez démarrer l'application à l'adresse http://localhost/RiskAnalysis/
``` 
	ID : connexion@admin
	PASSWORD : admin
```
