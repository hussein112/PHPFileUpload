<?php
/**
 * uploaded is stored in a temporary place in the server. accessed by $_FILES['file']['tmp_name']
 * $_FILES['file'] => returns the name, type, tmp_name, error, size(in Bytes) of the uploaded file.
 * 
 */
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    


    $allowed_extensions = ["jpg", "jpeg", "png", "jfif"];

    
    $images = $_FILES['files'];

    $name = $images['name'];
    $type = $images['type'];
    $tmp = $images['tmp_name'];
    $error = $images['error'];
    $size = $images['size'];
    

    // Check if no file is uploaded
    if($error[0] == 4){ // 4 -> No file was uploaded.
        die("Please Choose a File to Upload");
    }


    for($i = 0; $i < count($images); $i++){
        $errors = [];
        
        
        
        // Check Size
        if($size[$i] > 200000){
            $errors['size'] = "Cannot Upload File More Than 200 000 Bytes.";
        }

        // Check Extensions
        $_name = explode(".", $name[$i]); 
        $extension = end($_name);
        if(! in_array($extension, $allowed_extensions)){
            $errors['extension'] = "Only Jpg, Jpeg, Png, and JFIF are allowed";
        }



        // Finally
        if(empty($errors)){
            move_uploaded_file($tmp[$i], __DIR__ . "\\Images\\" . $name[$i]);
            echo "<b>File " . $name[$i] . " Uploaded</b>";
        }else{
            echo "<b>" . $name[$i] . "</b>  ==>  ";
            foreach($errors as $error){
                echo $error . "<br>";
            }
        }
    }


    


    
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="files[]" multiple="multiple"><br><br>
    <input type="submit" name="upload" value="Upload">
</form>