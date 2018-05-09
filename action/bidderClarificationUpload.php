<?php
//todo: update submission comment
require_once "connection.php";
if($_POST['comment'] && $_POST['id']) {
    echo "Comment Posted: " . $_POST['comment'];
    echo "ID Posted: " . $_POST['id'];

    if ($_FILES) {
        echo "Posted " . count($_FILES['file']['name']) . " Files.";

        $submission_id = $_POST['id'];
        $count = count($_FILES['file']['name']);
        $subheading = "Addenda";
        $i = 0;
        for ($i; $i < $count; $i++) {
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
			VALUES('" . $name . "', '" . $filesPath . "'  ,'" . $subheading[$i] . "','" . $type . "', '" . $size . "', '" . $submission_id . "')";

                        $result = mysqli_query($bd, $query);
                        if (!$result) {
                            echo "Query Failed: " . mysqli_error($bd);
                        }else echo 'Uploaded!';

                    }
                }
            }
        }
    } else {
        echo "No files selected.";
    }
}else{
    echo "Please leave a comment for the reviewer.";
}