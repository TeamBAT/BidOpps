<?php
//todo: Change query to update "last_updated" row
require_once "connection.php";
if($_POST['comment'] && $_POST['id']) {
    $comment = mysqli_real_escape_string($bd, $_POST['comment']);
    $id = mysqli_real_escape_string($bd, $_POST['id']);

    $query = "UPDATE `submissions` SET `message` = $comment WHERE `submissions`.id = $id";

    $result = mysqli_query($bd, $query);
    if($result){
        echo "Success! Clarification sent for approval.\n";
    }
    else{
        echo mysqli_error($bd);
        exit();
    }

    if ($_FILES) {
        $submission_id = $_POST['id'];
        $count = count($_FILES['file']['name']);
        $subheading = "Addenda";

        for ($i = 0; $i < $count; $i++) {
            $name = $_FILES['file']['name'][$i];
            $size = $_FILES['file']['size'][$i];
            $type = $_FILES['file']['type'][$i];
            $tmp_name = $_FILES['file']['tmp_name'][$i];
            $position = strpos($name, ".");

            $fileextension = substr($name, $position + 1);

            $fileextension = strtolower($fileextension);

            if (isset($name)) {

                $path = '../BidderUploads/';
                $filesPath = "BidderUploads/$name";
                if (!empty($name)) {
                    if (move_uploaded_file($tmp_name, $path . $name)) {
                        $query = "INSERT INTO `submission_docs` (`filename`,`directory`,`subheading`, `filetype`, `filesize`, `submission_id`)
			VALUES('" . $name . "', '" . $filesPath . "'  ,'" . $subheading . "','" . $type . "', '" . $size . "', '" . $submission_id . "')";

                        $result = mysqli_query($bd, $query);
                        if (!$result) {
                            echo "Query Failed: " . mysqli_error($bd);
                        }else echo 'Files Uploaded!';
                    }
                }
            }
        }
    } else {
        echo "No files uploaded.";
    }
}else{
    echo "Please leave a comment for the reviewer.";
}