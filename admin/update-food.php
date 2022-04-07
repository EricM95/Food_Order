<?php include('partials/header.php'); ?>

<?php 

// Check if id is set or not
if(isset($_GET['id']))
{
    // Get details
    $id = $_GET['id'];

    // Query to get selected food
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

    $res2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_assoc($res2);

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];

}
else
{
    // Redirect to manage food
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Update Food</h1>

            <div style="width: 60%;">

                <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                        <label class="col-sm-3">Title:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="title" value="<?php echo $title; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Description: </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="description" cols="23" rows="3"><?php echo $description; ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Price: </label>
                        <div class="col-sm-9">
                            <input class="form-control" type="number" name="price" value="<?php echo $price; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Current Image: </label>
                        <div class="col-sm-9">
                            <?php 
                                if($current_image == "")
                                {
                                    // Image not available
                                    echo   "<div class='error'>Image not available</div>";
                                }
                                else
                                {
                                    // Image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="250px">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Select New Image: </label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" name="image">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3">Category: </label>
                        <div class="col-sm-9">
                            <select name="category" class="form-select">

                                <?php

                                    // Query to get active category
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                    // Execute query
                                    $res = mysqli_query($conn, $sql);
                                    // Count rows
                                    $count = mysqli_num_rows($res);

                                    // Check if category available or not
                                    if($count>0)
                                    {
                                        // Category available
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            $category_title = $row['title'];
                                            $category_id = $row['id'];

                                            // echo "<option value='$category_id'>$category_title</option>";
                                            ?>
                                                <option <?php if($current_category==$category_id){echo "selected";} ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php 
                                        }
                                    }
                                    else
                                    {
                                        // Category not available
                                        echo "<option value='0'>No Category Available</option>";
                                    }
                                
                                ?>
                            </select>
                        </div>
                    </div>

                    <fieldset class="row mb-3">
                        <label class="col-sm-3 text-align-center">Featured: </label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" class="form-check-input" name="featured" value="Yes">
                                <label class="form-check-label">Yes</label>
                            </div>

                            <div class="form-check">
                                <input <?php if($featured=="No") {echo "checked";} ?> type="radio" class="form-check-input" name="featured" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="row mb-3">
                        <label class="col-sm-3 text-align-center">Active: </label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" class="form-check-input" name="active" value="Yes">
                                <label class="form-check-label">Yes</label>
                            </div>

                            <div class="form-check">
                                <input <?php if($active=="No") {echo "checked";} ?> type="radio" class="form-check-input" name="active" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="col-12">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" class="btn btn-success btn-lg" value="Update Food">
                    </div>

                </form>

                <?php

                    if(isset($_POST['submit']))
                    {
                        // echo "button clicked";

                        // Get values from form
                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $current_image = $_POST['current_image'];
                        $category = $_POST['category'];

                        $featured = $_POST['featured'];
                        $active = $_POST['active'];

                        // Upload image if selected
                        // Check if upload button is clicked
                        if(isset($_FILES['image']['name']))
                        {
                            // Upload button clicked
                            $image_name = $_FILES['image']['name']; // new image name

                            // Check if file is available
                            if($image_name != "")
                            {
                                // Image available
                                // Rename image 
                                $ext = end(explode('.',$image_name)); // Gets extension of image

                                $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; // Rename image

                                // Get source path and destination path
                                $src_path = $_FILES['image']['tmp_name']; // Source path
                                $dest_path = "../images/food/".$image_name; // Destination path

                                // Upload image
                                $upload = move_uploaded_file($src_path, $dest_path);

                                // Check if image uploaded or not
                                if($upload == false)
                                {
                                    // Failed to upload
                                    $_SESSION['upload'] = "<div class='error'>Failed to upload new image</div>";
                                    // Redirect to manage food page
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    // Stop process
                                    die();
                                }

                                // Remove image if new image uploaded and current image exists
                                // Remove current image if available
                                if($current_image != "")
                                {
                                    // Current image available
                                    // Remove image
                                    $remove_path = "../images/food/".$current_image;

                                    $remove = unlink($remove_path);

                                    // Check if image is removed or not
                                    if($remove == false)
                                    {
                                        // Failed to remove current image
                                        $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image</div>";
                                        // Redirect to manage food
                                        header('location:'.SITEURL.'admin/manage-food.php');
                                        // Stop process
                                        die();
                                    }

                                }

                            }

                        }
                        else
                        {
                            $image_name = $current_image;
                        }


                        // Update food in database
                        $sql3 = "UPDATE tbl_food SET
                            title = '$title',
                            description = '$description',
                            price = $price,
                            image_name = '$image_name',
                            category_id = '$category',
                            featured = '$featured',
                            active = '$active'
                            WHERE id=$id
                        ";

                        $res3 = mysqli_query($conn, $sql3);

                        // Check if query executed or not
                        if ($res3 == true)
                        {
                            $_SESSION['update'] = "<div class='success'>Food updated successfully</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }
                        else
                        {
                            // Failed to update
                            $_SESSION['update'] = "<div class='error'>Failed to update</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }

                        // Redirect to manage food with session message
                    }

                ?>

            </div>

        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>