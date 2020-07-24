<?php

//The name of the folder.
$folder = '../../../image';
 
//Get a list of all of the file names in the folder.
$files = glob($folder . '/*');
 
//Loop through the file list.
foreach($files as $file){
    //Make sure that this is a file and not a directory.
    if(is_file($file)){
        //Use the unlink function to delete the file.
        unlink($file);
    }
}

use function PHPSTORM_META\type;

//set directory
$uploaddir  = "../../../image/";
//set future name of the file
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$uploadOk = 1;

//check type of the file, ie: JSON  
$fileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));

if ($fileType != "zip") {
  print "Sorry, only zip files are allowed.";
} 
else {
    if (isset($_POST["importer_image"])) {
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
    $image = file_get_contents($uploadfile);
    $filename = "../../../image/". basename($_FILES["userfile"]["name"]);
    
    $zip = new ZipArchive;
    if ($zip->open($filename) === TRUE) {
        $zip->extractTo('../../../image/');
        $zip->close();
        echo 'ok';
    } else {
        echo 'échec';
    }

    if(rename($filename,"../sauvegarde_image/schema.zip")){
        print "yes";
    } else{
        print "no";
    }
}
?>