<?php
require_once('connection.php');
if(isset($_POST)){
    if(isset($_POST['data'])){
        $data = json_decode($_POST['data']);
        $items=0;
        while($items<count($data)){
            if($data[$items]->subheading=="Required"){
                $priority=$data[$items]->priority;
                $id=$data[$items]->id;
                $query = "UPDATE `opportunity_docs` SET `priority`='$priority'  WHERE `document_id` = '$id'";
                mysqli_query($bd, $query);
            echo $data[$items]->id;

            }
            $items++;
        }
        
}
}
?>