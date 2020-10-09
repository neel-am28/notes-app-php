<?php 
    require("db.inc.php");
    $id = $_POST['id'];
    $select = "SELECT * from `notes` where `id` = '$id' ";
    $query = mysqli_query($conn, $select);
    $num_rows = mysqli_num_rows($query);
    if($num_rows > 0){
        while($result=mysqli_fetch_assoc($query)){
            $data[] = $result;
        }
    }else{
        $data = [];
    }
	echo json_encode($data);
?>