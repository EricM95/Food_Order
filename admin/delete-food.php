<?php 
    include('../config/constants.php');

    // echo "Delete food page";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // Process delete
        // echo "Process to delete";

        // Get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove image if available
        // Check if image available
        if($image_name != "")
        {
            // Has image and remove from folder
            // Get image path
            $path = "../images/food/".$image_name;

            // Remove image file from folder
            $remove = unlink($path);

            // Check if image is removed or not
            if($remove==false)
            {
                // Failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file</div>";
                // Redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop delete process
                die();
            }

        }

        // Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        // Execute query
        $res = mysqli_query($conn, $sql);

        // Check if query executed 
        if($res == true)
        {
            // Food deleted
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // Redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }
    else
    {
        // Redirect to manage food page
        // echo "Redirect";
        $_SESSION['unauthorized'] = "<div class='error'>Unathorized Access</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>