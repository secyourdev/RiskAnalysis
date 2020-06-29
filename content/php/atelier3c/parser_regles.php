<?php
// header('Location: ../../../atelier-3c');

//set directory
$target_dir = "../../../uploads/";
//set future name of the file
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
//check type of the file, ie: JSON  
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
// if (isset($_POST["file_submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if ($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

if (isset($_POST["file_submit"])) {
  $sJson = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
  //try to decode it
  $json = json_decode($sJson);
  if (json_last_error() === JSON_ERROR_NONE) {
    //do something with $json. It's ready to use
    echo "File is a json.";
    $uploadOk = 1;
  } else {
    //yep, it's not JSON. Log error or alert someone or do nothing
    echo "File is not a json.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// Allow certain file formats
// if (
//   $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
//   && $fileType != "gif"
// ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// Allow certain file formats
if (
  $fileType != "json"
) {
  echo "Sorry, only json files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

