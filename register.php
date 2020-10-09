<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notes | Register</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Registration Form</h2>
        </div>
        <form class="form" id="regForm" method="post">
            <div class="form-control">
                <label>Username</label>
                <input required name="username" type="text" id="username" placeholder="Enter username" autocomplete="off">
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>error msg</small>
            </div>
            <div class="form-control">
                <label>Email Address</label>
                <input required name="email" type="text" id="email" placeholder="Enter email address" autocomplete="off">
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>error msg</small>
                <p id="error_msg" style="color:red; margin-top: 10px;"></p>
            </div>
            <div class="form-control">
                <label>Password</label>
                <input required name="password" type="password" id="password" placeholder="Enter password">
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>error msg</small>
            </div>
            <div class="form-control">
                <label>Confirm Password</label>
                <input required name="cpassword" type="password" id="cpassword" placeholder="Re-enter password">
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>error msg</small>
            </div>
            <button type="submit" class="btn" name="submit">Submit</button>
        </form>
    </div>
    <script src="register.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>