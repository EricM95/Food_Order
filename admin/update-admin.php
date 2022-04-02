<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <?php  
                // Get id of selected admin
                $id=$_GET['id'];

                // Create sql query  to get the details
                $sql = "SELECT * FROM tbl_admin WHERE id=$id";

                // Execute query
                $res = mysqli_query($conn, $sql);

                // Check query executed
                if($res==true)
                {
                    // Check data is available or not
                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                        // Get details
                        //echo "Admin Available";
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                    else
                    {
                        // Redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

            ?>

            <form action="" method="POST">
                <div class="row mb-3">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Full name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="full_name" value="<?php echo $full_name; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Username:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                    </div>
                </div>

                <div class="col-auto">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" name="submit" class="btn btn-success">Update Admin</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php

    // Check submit button clicked or not
    if(isset($_POST['submit']))
    {
        // echo "Button Clicked";
        // Get values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // Create query to update admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        // Execute query
        $res = mysqli_query($conn, $sql);

        // Check if query executed
        if($res==true)
        {
            // Query executed
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // Failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

    }

?>


<?php include('partials/footer.php') ?>