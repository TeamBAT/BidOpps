<?php 
require_once('connection.php');
if($_FILES)
  { 
    $count = count($_FILES['file']['name']);
    $i= 0;
    while ($i<$count)
     {
        $name= $_FILES['file']['name'][$i];
        $size= $_FILES['file']['size'][$i];
        $type= $_FILES['file']['type'][$i];
        $tmp_name= $_FILES['file']['tmp_name'][$i];
        
        $position= strpos($name, "."); 
        
        $fileextension= substr($name, $position + 1);
        
        $fileextension= strtolower($fileextension);
        
        if (isset($name)) {
        
        $path= '../Uploads/';
        $filesPath= "Uploads/$name";
        if (!empty($name)){
        if (move_uploaded_file($tmp_name, $path.$name)) {
        $i++;
        $query = "INSERT INTO `opportunity_docs` (`filename`,`directory`, `filetype`, `filesize`, `opportunity_id`)
			VALUES('".$name."', '".$filesPath."'  ,'".$type."', '".$size."', '".$_SESSION['opportunity_id']."')";
	
	        $result = mysqli_query($bd, $query);
	        if(!$result){
	        	echo mysqli_error($bd);
            }
        echo 'Uploaded!';
        
        }
        }
        }
     }
    }
else{
    echo "ridi";
}
?>