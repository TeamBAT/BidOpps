<?php 
require_once('connection.php');
if($_FILES){
    $query = "INSERT INTO `submissions` ()";
    $result = mysqli_query($bd, $query);
    if($result){
        $submission_id = mysqli_insert_id($bd);
    }
    else{
        echo "Submission insert failed";
    }
    $count = count($_FILES['file']['name']);
    $subheading=$_POST['subheading'];
    $i= 0;
    while ($i<$count)
     {
        $name= $_FILES['file']['name'][$i];
        $size= $_FILES['file']['size'][$i];
        $type= $_FILES['file']['type'][$i];
        $tmp_name= $_FILES['file']['tmp_name'][$i];
        $opportunity_id = $_SESSION['bidDocs'];
        $position= strpos($name, ".");  
        
        $fileextension= substr($name, $position + 1);
        
        $fileextension= strtolower($fileextension);
        
        if (isset($name)) {
        
        $path= '../BidderUploads/';
        $filesPath= "Uploads/$name";
        if (!empty($name)){
        if (move_uploaded_file($tmp_name, $path.$name)) {
            $i++;
        $query = "INSERT INTO `submission_docs` (`filename`,`directory`,`subheading`, `filetype`, `filesize`, `submission_id`)
			VALUES('".$name."', '".$filesPath."'  ,'".$subheading[$i]."','".$type."', '".$size."', '".$submission_id."')";
	
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