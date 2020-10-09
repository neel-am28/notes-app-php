<?php 
    require("db.inc.php");
    $title = $_POST['title'];
    $text = $_POST['text'];
    $userid = $_POST['userid'];

    $insert = "INSERT INTO `notes`(`title`, `text`, `userid`) VALUES ('$title', '$text', '$userid')";

    $query = mysqli_query($conn, $insert);
    if($query){
        $data = array("msg" => "Note Added!", "className" => "success");
    } else{
        $data = array("msg" => "Error adding note!", "className" => "danger");
    }

    echo json_encode($data);
?>