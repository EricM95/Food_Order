<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br>

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            ?>

            <form action="" method="POST">

                <div class="row mb-3 align-items-center">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Current Password:</label>
                    <div class="col-sm-9">
                        <input type="password" name="current_password" placeholder="Current Password">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="inputPassword1" class="col-sm-3 col-form-label">New Password:</label>
                    <div class="col-sm-9">
                        <input type="password" name="new_password" placeholder="New Password">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="inputPassword2" class="col-sm-3 col-form-label">Confirm Password:</label>
                    <div class="col-sm-9">
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="col-auto">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" name="submit" class="btn btn-success">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

// Check if submit button is clicked
if (isset($_POST['submit'])) {
    // echo "Clicked";

    // Get data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Check if user with current ID and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    // Execute query
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        // Check data is available 
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // User exists and password can be changed
            // echo "User Found";
            // Check if new and current password match
            if ($new_password == $confirm_password) {
                // Update password
                $sql2 = "UPDATE tbl_admin SET
                password='$new_password' 
                WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                // Check if query executed
                if($res2==true)
                {
                    // 
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
                else
                {
                    // Display error
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change password.</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }


            } else {
                // Redirect to manage admin page with error
                $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match.</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            // User does not exist
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }

    // Check if new password and confirm password match or not

    // Change password if all above is true
}

?>

<?php include('partials/footer.php') ?>