<?php include('partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Add Admin</h1>

            <?php 
                if(isset($_SESSION['add'])) // Check whether session is set or not
                {
                    echo $_SESSION['add']; 
                    unset($_SESSION['add']); // Remove session message
                }
            ?>

            <form action="" method="POST" class="my-4">
                <div class="row mb-3">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Full name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="full_name" placeholder="Enter your name" aria-label="Full Name">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Username:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Enter your username" aria-label="Username">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Enter your password" aria-label="Full Name">
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-success" type="submit" name="submit" value="Add Admin">Add Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
// Process value from form and save it in database

if (isset($_POST['submit'])) {
    // Button clicked
    // echo "Button Clicked";

    // Get data from form

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Password encryption with MD5

    // SQL query to save data to database

    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
       ";

}

// Execute query and save data in database

$res = mysqli_query($conn, $sql);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

// Check whether data is inserted or not and display appropiate message
if($res==TRUE)
{
   // echo "Data inserted";
   $_SESSION['add'] = "Admin Added Successfully";
   // Redirect
    header("location:".SITEURL.'admin/manage-admin.php');
}
else
{
    //echo "Failed to insert data";
    $_SESSION['add'] = "Failed to add admin";
   // Redirect to Add Admin
   header("location:".SITEURL.'admin/add-admin.php');
}

?>