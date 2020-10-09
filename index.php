<?php 
    require("db.inc.php");
    session_start();
    // var_dump($_SESSION);
    if(isset($_SESSION['USER_ID']) && $_SESSION['IS_LOGGED_IN'] == true){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notes App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-fluid mx-0 px-0">
        <div class="d-flex align-items-center justify-content-end mt-4">
            <p class="text-white align-self-center mr-3">Welcome, <?php echo ucfirst($_SESSION['USER_NAME']) ?></p>
            <button class="btn btn-info mr-3 align-self-center" id="logout">Logout</button>
        </div>
        <div class="container" style="margin-top: 1rem" id="main">
            <h1 class="text-center text-white stickit">stick-it!</h1>
            <form class="mt-4">
                <div class="note col-md-6 offset-md-3">
                    <div class="form-group alert-div-before">
                        <input type="hidden" value="<?php echo $_SESSION['USER_ID'] ?>" id="userid"> 
                        <input class="form-control mr-sm-2 search sh" type="search" placeholder="Search by title" aria-label="Search"
                            id="searchTxt" autocomplete="off">
                    </div>
                <div class="card-body rounded bg-white sh" id="edit">
                    <div class="form-group">
                        <h5 class="title text-dark">Add a title</h5>
                        <input type="text" class="form-control" id="addTitle"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <h5 class="card-title text-dark">Add a note</h5>
                        <textarea class="form-control" id="addTxt" rows="2"></textarea>
                    </div>
                    <button class="btn btn-info btn-block" id="addBtn">Add Note</button>
                </div>
            </div>
        </form>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" id="openModal">
                    </div>
                </div>
            </div>

            <div id="notes" class="mt-5 row justify-content-md-center">

            </div>

            <p id="noShow" class="col-md-6 alert alert-warning container-fluid font-weight-bolder" role="alert"
                style="display: none;">
                Nothing to show!'
            </p>
        </div>
    </div>



    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>

</html>
<?php 
    }
    else{
        header("location: login.php");
        exit;
    }
?>