<?php 

    include('../config/constants.php');

    error_reporting(E_ALL);

    // Check if id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get value and delete
        // echo "Get value and delete";

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove physical image is available
        if($image_name != "")
        {
            // Image is available and remove it
            $path = "../images/category/".$image_name;
            // Remove image
            $remove = unlink($path);

            // If failed to remove add an error message
            if($remove==false)
            {
                // Set session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                // Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }

        // Delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        // Check if data is deleted from database
        if($res==true)
        {
            // Set success message
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }


        // Redirect to manage category page

    }
    else
    {
        // Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>