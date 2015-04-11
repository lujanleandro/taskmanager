<?php
    // Cargador por ajax del file.
	$filesUploaded = array();
    foreach($_FILES['images']['error'] as $key => $error){
        if($error == UPLOAD_ERR_OK){
            $name = $_FILES['images']['name'][$key];
            move_uploaded_file($_FILES['images']['tmp_name'][$key], 'c:/trabajo/tasks/website/cms/uploadedfiles/' . $name);

        	$filesUploaded[$key] = $name;
        	echo "<input type='hidden' name='filesForUpload[]' value='".$name."'/>";
        }
    }
    echo "<input type='hidden' name='newFilesUpload' value='1'/>";
    echo "<h3>Archivos correctamente subidos</h3>";
?>