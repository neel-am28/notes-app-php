<?php 
    require("db.inc.php");
    $title = $_POST['title'];
    $text = $_POST['text'];
    $id = $_POST['id'];

    $update = "UPDATE `notes` SET `title` = '$title', `text` = '$text' WHERE `id` = $id";

    $query = mysqli_query($conn, $update);
    if(!$query){
        $data = array("msg" => "Error updating note!", "className" => "danger");       
    }
    $data = array("msg" => "Note Updated!", "className" => "success");
    echo json_encode($data);
?>