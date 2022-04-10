<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <header class="navbar navbar-default navbar-expand-md custom-color navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" target="#navbarNav" aria-controls="navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav flex-row pt-2">
                    <li class="nav-item p-2">
                        <a class="nav-link p-2" href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link p-2" href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link p-2" href="<?php echo SITEURL; ?>foods.php">Menu</a>
                    </li>
                    <li class="nav-item p-2" class="nav-item">
                        <a class="nav-link p-2" href="#">Contact</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ms-auto">
                    <li class="nav-item p-2">
                        <a class="nav-link" aria-current="page" href="#">My Basket</a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link" aria-current="page" href="#"><i class="bi bi-box-arrow-in-right"></i>Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- Navbar Section Ends Here -->

    <!-- Secondary Nav -->

<nav class="subnavbar py-2" aria-label="Secondary navbar">
    <div class="container">
        <h3 class="brand text-center">Gardenia Chinese Takeaway</h3>
    </div>
</nav>

    <!-- Secondary Nav End -->