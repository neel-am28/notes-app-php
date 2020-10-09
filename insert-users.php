<?php 
    require("db.inc.php");
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $check_email = "SELECT * FROM `users` WHERE `email` = '".$email."' ";
    $query = mysqli_query($conn, $check_email); 
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        if($email==$row['email'])
        {
            $data = array('error' => true, 'msg' => "This email is already in use. Please use a different email address to continue");
        } 
    } else{
        $insert = "INSERT INTO `users`(`username`, `email`, `password`, `cpassword`) VALUES ('$username', '$email', '$password', '$cpassword')";
        mysqli_query($conn, $insert);
        $data = array('error' => false, 'msg' => "Registration successful");
    }
    echo json_encode($data);
?>