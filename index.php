<?php
/**
 * uploaded is stored in a temporary place in the server. accessed by $_FILES['file']['tmp_name']
 * $_FILES['file'] => returns the name, type, tmp_name, error, size(in Bytes) of the uploaded file.
 * 
 */
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $errors = [];

    $allowed_extensions = ["jpg", "jpeg", "png", "jfif"];

    $images = $_FILES['files'];
    
    $name = explode(".", $images['name']); // Remove all the dots from the name
    // $name = [0] -> file name, [1] -> file extension
    // In case of multiple files
    $extension = end($name);
    if(! in_array($extension, $allowed_extensions)){
        $errors['extension'] = "Only Jpg, Jpeg, Png, and JFIF are allowed";
    }



    // for($i = 0; $i < count($images); $i++){
    //     echo $name[$i];
    //     move_uploaded_file($tmp[$i], __DIR__ . "\\Images\\" . $name[$i]);
    // }

    // if($size > 10000){
    //     $errors['size'] = "File Cannot Be More Than 10 000 Bytes.";
    // }
    // if($error == 4){ // 4 -> No file was uploaded.
    //     $errors['empty_file'] = "Please Choose a File to Upload";
    // }


    if(empty($errors)){
        move_uploaded_file($images['tmp_name'], __DIR__ . "\\Images\\" . $images['name']);
        echo "File Uploaded";
    }else{
        foreach($errors as $error){
            echo $error . "<br>";
        }
    }
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="files" multiple="multiple"><br><br>
    <input type="submit" name="upload" value="Upload">
</form>