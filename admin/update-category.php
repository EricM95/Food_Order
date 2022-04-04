<?php  include('partials/header.php'); ?>

    <div class="main-content">
        <div class="container">
            <div class="wrapper">
                <h1>Update Category</h1>

                <?php

                    if(isset($_GET['id']))
                    {
                        // Get ID and other details
                        $id = $_GET['id'];
                        // Query to get all other details
                        $sql = "SELECT * FROM tbl_category WHERE id=$id";

                        // Execute query
                        $res = mysqli_query($conn, $sql);

                        // Count rows to check if id is valid
                        $count = mysqli_num_rows($res);

                        if($count==1)
                        {
                            // Get data
                            $row = mysqli_fetch_assoc($res);
                            $title = $row['title'];
                            $current_image = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                        }
                        else
                        {
                            // Redirect 
                            $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }

                    }
                    else
                    {
                        // Redirect to manage category page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }

                ?>

                <form action="" method="POST" enctype="multipart/form-data" class="mt-4">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fs-4">Title: </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="form-label col-sm-3 fs-4">Current Image:</label>

                    <div class="col-sm-9">
                       <?php if($current_image != "")
                       {
                           // Display image 
                           ?>
                           <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="200px">
                           <?php 
                       } 
                       else
                       {
                           // Display error message
                           echo "<div class='error'>Image not added</div>";
                       }
                       
                       ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="form-label col-sm-3 fs-4">New Image:</label>
                    
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend for="" class="col-sm-3 text-align-center">Featured: </legend>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input <?php if($featured=="Yes"){ echo "checked"; } ?> type="radio" class="form-check-input" name="featured" value="Yes">
                            <label class="form-check-label">Yes</label>
                        </div>

                        <div class="form-check">
                            <input <?php if($featured=="No"){ echo "checked"; } ?> type="radio" class="form-check-input" name="featured" value="No">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3">
                    <legend for="" class="col-sm-3 text-align-center">Active: </legend>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input <?php if($active=="Yes"){ echo "checked"; } ?> type="radio" class="form-check-input" name="active" value="Yes">
                            <label class="form-check-label">Yes</label>
                        </div>

                        <div class="form-check">
                            <input <?php if($active=="No"){ echo "checked"; } ?> type="radio" class="form-check-input" name="active" value="No">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </fieldset>

                <div class="col-auto">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn btn-success btn-lg">
                </div>

            </form>

            <?php 
            
                if(isset($_POST['submit']))
                {
                    //echo "Submit clicked";
                    // Get values from form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    // Updateing new image if selected
                    // Check if image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        // Get image details
                        $image_name = $_FILES['image']['name'];

                        // Check if image is available
                        if($image_name != "")
                        {
                            // Image available
                            // A. Upload new image

                            // Auto rename image
                            // Get extension of image (jpg, png, gif, etc)
                            $ext = end(explode('.', $image_name));

                            // Rename image 
                            $image_name = "Food_Category_".rand(000, 999).'.'.$ext; 

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            $upload = move_uploaded_file($source_path, $destination_path);

                            // Check if image uploaded or not
                            // If image not uploaded, stop process and redirect with error message
                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                                // Redirect to add category page
                                header('location'.SITEURL.'admin/manage-category.php');
                                // Stop process
                                die();
                            }

                            // B. Remove current image
                            if($current_image!="")
                            {
                                $remove_path = "../images/category/".$current_image;

                                $remove = unlink($remove_path);

                                // Check if image is removed
                                // If failed to remove image, display message and stop process
                                if($remove==false)
                                {
                                    // Failed to remove image
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                            }

                        }
                        else
                        {
                            $image_name = $current_image;
                        }

                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    // Update database
                    $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                    ";

                    // Execute query
                    $res2 = mysqli_query($conn, $sql2);

                    // Redirect with message
                    // Check if query executed or not
                    if($res2==true)
                    {
                        // Category updated
                        $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        // Failed to update
                        $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }

                }
            
            ?>

            </div>
        </div>
    </div>

<?php  include('partials/footer.php'); ?>