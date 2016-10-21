<?php
 function uploadFile()
 {
$target_dir = '../uploads/';
$uploaded_file = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($uploaded_file,PATHINFO_EXTENSION));
$target_file = $target_dir . "image." . $imageFileType;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
print_r($_POST["fileToUpload"]);
	
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "<script>alert('File is an image - " . $check["mime"] . ".')</script>";
        $uploadOk = 1;
    } else {
       //echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "<script>alert('Sorry, file already exists.')</script>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    //echo "<script>alert('Sorry, your file is too large.')</script>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.   ". $imageFileType;
	return "upload_invalid";
	
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		return $target_file;
    } else {
		return "upload_error";
    }
}
}
?>