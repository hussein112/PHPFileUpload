<?php
/**
 * uploaded is stored in a temporary place in the server. accessed by $_FILES['file']['tmp_name']
 * $_FILES['file'] => returns the name, type, tmp_name, error, size(in Bytes) of the uploaded file.
 * 
 */
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $errors = [];

    $images = $_FILES['files']; 


    $name = $_FILES['files']['name'];
    $type = $_FILES['files']['type'];
    $tmp = $_FILES['files']['tmp_name'];
    $error = $_FILES['files']['error'];
    $size = $_FILES['files']['size'];



    for($i = 0; $i < count($images); $i++){
        echo $name[$i];
        move_uploaded_file($tmp[$i], __DIR__ . "\\Images\\" . $name[$i]);
    }

    // if($size > 10000){
    //     $errors['size'] = "File Cannot Be More Than 10 000 Bytes.";
    // }
    // if($error == 4){ // 4 -> No file was uploaded.
    //     $errors['empty_file'] = "Please Choose a File to Upload";
    // }


    // if(empty($errors)){
    //     move_uploaded_file($tmp, __DIR__ . "\\Images" . $name);
    //     echo "File Uploaded";
    // }else{
    //     foreach($errors as $error){
    //         echo $error . "<br>";
    //     }
    // }
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="files[]" multiple="multiple"><br><br>
    <input type="submit" name="upload" value="Upload">
</form>