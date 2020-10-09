<?php  
    require("db.inc.php");
    session_start();
    // session_destroy();
    // var_dump($_SESSION);
    $email = $password = $emailError = $passError = $errorMsg = "";
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $select = "SELECT  * from `users` WHERE `email` = '".$email."' && `password` = '".$password."' ";
        $result = mysqli_query($conn, $select);
        $res = mysqli_fetch_assoc($result);
        if($res){
            $_SESSION['USER_NAME'] = $res['username'];
            $_SESSION['USER_ID'] = $res['id'];
            $_SESSION['IS_LOGGED_IN'] = true;
            header("location: index.php");
        }
        else{
            if($res['email'] != $email){
                $errorMsg = "Either email id or password don't match";
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notes | Login</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Login Form</h2>
        </div>
        <form class="form" id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="user_id" id="user_id">
            <div class="form-control">
                <label>Email</label>
                <input name="email" type="text" id="email" placeholder="Enter email" autocomplete="off" required>
            </div>
            
            <div class="form-control">
                <label>Password</label>
                <input name="password" type="password" id="password" placeholder="Enter password" required>
            </div>
            <span style="color: red;"><?php echo $errorMsg; ?></span>
            
            <input type="submit" value="Login" class="btn" name="login" id="login">
        </form>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>