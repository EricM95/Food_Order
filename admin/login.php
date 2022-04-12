<?php include('../config/constants.php') ?>

<html>

<head>
    <title>Login - Food Order System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>



    <div class="login">
        <h1 class="text-center">Login</h1>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }

        ?>

        <form method="POST">
            <div class="form-outline mb-4">
                <label class="form-label">Username: </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">Password: </label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="d-grid mb-4 gap-2 col-6 mx-auto">
                <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Sign In">
            </div>
        </form>

        <p class="text-center">Created by Eric Man</p>
        <div class="clearfix"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php

// Check if submit button is clicked
if (isset($_POST['submit'])) {
    // Process for login
    // Get data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQL to check if username and password exists
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Count rows to check if user exists in table
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User found and login success
        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username; // To check if user logged in or not and logout will unset it

        // Redirect to dashboard
        header('location:' . SITEURL . 'admin/');
    } else {
        // User not available
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}

?>