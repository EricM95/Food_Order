<?php include('partials/header.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Management</h1>

            <?php
            if (isset($_SESSION['add'])) 
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])) 
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }

            ?>

            <br>

            <a class="btn btn-primary my-4 fw-bold" href="add-admin.php">Add Admin</a>

            <table class="table table-dark table-bordered">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // Query to get all
                    $sql = "SELECT * FROM tbl_admin";
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE) {

                        $count = mysqli_num_rows($res);

                        $sn = 1; // Create a variable and assign the value

                        if ($count > 0) {


                            while ($rows = mysqli_fetch_assoc($res)) {
                                // Get data 
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];
                    ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>">Change Password</a>
                                        <a class="btn btn-success" href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>">Update Admin</a>
                                        <a class="btn btn-danger" href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>">Delete Admin</a>
                                    </td>
                                </tr>

                    <?php }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>