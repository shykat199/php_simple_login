<?php

$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # code...

    include("../Loginsys/partial/_dbconnect.php");

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $exists = false;

    if (($password == $cpassword) && $exists == false) {
        //$sql = "SELECT * FROM users WHERE `username`='$username' AND `password`='$password'";
        $sql = "SELECT * FROM users WHERE `username`='$username'";

        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);

        if (($result) && $num == 1) {
            #$showAlert = true;

            while ($row = mysqli_fetch_assoc($result)) {

                if (password_verify($password, $row['password'])) {
                    $login = true;

                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;

                    //redirect function....
                    header("location:welcome.php");
                }else {
                    #$showError = "Password and confirm password is not same";
                    $showError = "Invalid Crediential";
                }
            }
        }
    } else {
        #$showError = "Password and confirm password is not same";
        $showError = "Invalid Crediential";
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>LogIn</title>
</head>

<body>
    <?php

    require '../Loginsys/partial/_nav.php';
    ?>

    <?php
    if ($login) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert mt-2">
                    <strong>Success..!!!!</strong> You are logged in.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert mt-2">
                    <strong>Success..!!!!</strong> ' . $showError . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }


    ?>



    <div class="container">
        <h1 class="text-center mt-2">Login to our website</h1>

    </div>


    <div class="container mt-5">
        <center>
            <form class="" action="../Loginsys/login.php" method="POST">
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword">
                </div>

                <button type="submit" class="btn btn-primary col-md-6" name="submit">LogIn</button>
            </form>
        </center>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>