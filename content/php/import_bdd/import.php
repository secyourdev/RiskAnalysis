<?php

use function PHPSTORM_META\type;

//set directory
$uploaddir  = "../../../bdd/";
//set future name of the file
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$uploadOk = 1;

//check type of the file, ie: JSON  
$fileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));

if ($fileType != "sql") {
  print "Sorry, only sql files are allowed.";
} 
else {
    if (isset($_POST["importer_bdd"])) {
        $sSQL = file_get_contents($_FILES["userfile"]["tmp_name"]);
    }
    // Check if file already exists -- if exist overwrite to update
    if (file_exists($uploadfile)) {
        print "you are about to overwrite already existing file: ";
        print $uploadfile;
        print '<br />';

        unlink($uploadfile);
        $uploadOk = 1;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // print "Your file was not uploaded. ";

        // if everything is ok, try to upload file
    }
    else {
        if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploadfile)) {
        print "The file " . basename($_FILES["userfile"]["name"]) . " has been uploaded. ";
        }
        else {
        print "Sorry, there was an error uploading your file. ";
        }
    }
    //read the json file uploaded
    $sql = file_get_contents($uploadfile);
    $filename = "../../../bdd/". basename($_FILES["userfile"]["name"]);

    // Connect to MySQL server
    include("../bdd/connexion_sqli.php");

    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines = file($filename);
    // Loop through each line
    foreach ($lines as $line)
    {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';')
        {
            // Perform the query
            mysqli_query($connect,$templine);
            // Reset temp variable to empty
            $templine = '';
        }
    }
 echo "Tables imported successfully";
 unlink($uploadfile);
}
?>