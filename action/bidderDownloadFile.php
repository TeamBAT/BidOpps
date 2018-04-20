<?php
require_once('connection.php');
$opportunityId= $_SESSION['bidDocs'];
$qry="SELECT * FROM opportunity_docs WHERE opportunity_id='$opportunityId'";
	        $result=mysqli_query($bd, $qry);
            $file="../Uploads/";
            $zipname = 'file.zip';
            $zip = new ZipArchive;
            $zip->open($zipname, ZipArchive::CREATE);
            while ($row = mysqli_fetch_assoc($result)) {
                $zip->addFile("../Uploads/".$row['filename'],$row['filename']);
            }
            $zip->close();
            mysqli_free_result($result);
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename='.$zipname);
            header('Content-Length: ' . filesize($zipname));
            readfile($zipname);
            unlink($zipname);
?>