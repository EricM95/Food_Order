<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Add Food</h1>

            <?php
            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            
            ?>

            <div style="width: 60%;">
                <form action="" method="post" enctype="multipart/form-data" class="my-4">
                    <div class="row mb-3">
                        <label class="col-sm-3">Title:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="title" placeholder="Title of Food">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Description: </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="description" cols="23" rows="3" placeholder="Description of Food"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Price: </label>
                        <div class="col-sm-9">
                            <input class="form-control" type="number" name="price" placeholder="Price">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Select Image: </label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" name="image">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Category: </label>
                        <div class="col-sm-9">
                            <select class="form-select" data-style="btn-secondary" name="category">

                                <?php 
                                
                                    // PHP to display categories from database
                                    // Create query to get all active categories
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    // Execute query
                                    $res = mysqli_query($conn, $sql);

                                    // Count rows to check if we have categories or not
                                    $count = mysqli_num_rows($res);

                                    // If count is greater than 0, we have categories else we don't have categories
                                    if($count>0)
                                    {
                                        // We have categories
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            // Get details of categories
                                            $id = $row['id'];
                                            $title = $row['title'];

                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php 
                                        }
                                    }
                                    else
                                    {
                                        // No categories
                                        ?>
                                            <option value="0">No category found</option>
                                        <?php 
                                    }

                                    // Display in dropdown 
                                
                                ?>

                            </select>
                        </div>
                    </div>

                    <fieldset class="row mb-3">
                        <label class="col-sm-3 text-align-center">Featured: </label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="featured" value="Yes">
                                <label class="form-check-label">Yes</label>
                            </div>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="featured" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="row mb-3">
                        <label class="col-sm-3 text-align-center">Active: </label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="active" value="Yes">
                                <label class="form-check-label">Yes</label>
                            </div>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="active" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="col-12">
                        <input type="submit" name="submit" class="btn btn-success btn-lg" value="Add Food">
                    </div>
                </form>

                <?php 
                
                // Check if button is clicked 
                if(isset($_POST['submit']))
                {
                    // Add food into database
                    // Get data from form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    // Check if radio buttons are checked or not#
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No"; // Set default value
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No"; // Set default value
                    }

                    // Upload image if selected
                    // Check if select image is clicked or not and upload image only if image is selected
                    if(isset($_FILES['image']['name']))
                    {
                        // Get details of selected image
                        $image_name = $_FILES['image']['name'];

                        // Check if image is selected or not and upload image only if selected
                        if($image_name != "")
                        {
                            // Image selected
                            // Rename image
                            // Get extension of image (jpg, png, gif)
                            $ext = end(explode('.', $image_name));
                            
                            // Create new image name
                            $image_name = "Food-Name-".rand(0000, 9999).".".$ext; // New image name

                            // Upload image
                            // Get src path and destination path

                            // Src path is currrent location of image
                            $src = $_FILES['image']['tmp_name'];

                            // Dest. path for image to be uploaded
                            $dst = "../images/food/".$image_name;

                            // Finally, upload food image
                            $upload = move_uploaded_file($src, $dst);

                            // Check if image uploaded or not
                            if($upload==false)
                            {
                                // Failed to upload image
                                // Redirect to Add Food page with error message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                header('location:'.SITEURL.'admin/add-food.php');
                                // Stop process
                                die();
                            }


                        }

                    }
                    else
                    {
                        $image_name = ""; // Set default value as blank
                    }

                    // Insert into database
                    // Create query to add food
                    $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                    ";
                    
                    // Execute query
                    $res2 = mysqli_query($conn, $sql2);

                    // Check if data inserted or not
                    // Redirect with message to manage food page
                    if($res2 == true)
                    {
                        // Data inserted successfully
                        $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        // Failed to insert
                        $_SESSION['add'] = "<div class='error'>Failed to add food</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }


                }
                
                ?>

            </div>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>