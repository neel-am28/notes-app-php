<?php 
require("db.inc.php");
$id = $_POST['id'];
$delete = "DELETE FROM `notes` WHERE `id` = '$id'";
$query = mysqli_query($conn, $delete);
if(!$query){
    $data = array("message" => "error"); 
}
$data = array("message" => "success");
echo json_encode($data);
?>