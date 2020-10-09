<?php 
    require("db.inc.php");
    $userid = $_POST['userid'];
    $select = "SELECT * from `notes` where `userid` = '$userid' ";
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