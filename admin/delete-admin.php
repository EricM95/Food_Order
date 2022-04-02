<?php 
    include('../config/constants.php');

    // Get ID of Admin to be deleted
    $id = $_GET['id'];

    // Create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute query
    $res = mysqli_query($conn, $sql);

    // Check whether query executed successfully or not
    if($res==true)
    {
        // Success
       // echo "Admin deleted";
       // Create session variable to display message
       $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
       // Redirect to admin page
       header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Failed to delete admin";

        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try Again Later</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    // Redirect to manage admin page with message (success/error)
?>