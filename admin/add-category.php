<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Add Category</h1>

            <?php

            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            ?>

            <!-- Add Category Form starts -->
            <form action="" method="POST" enctype="multipart/form-data" class="mt-4">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fs-4">Title: </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" placeholder="Category Title">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="form-label col-sm-3 fs-4">Select Image:</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend for="" class="col-sm-3 text-align-center">Featured: </legend>
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
                    <legend for="" class="col-sm-3 text-align-center">Active: </legend>
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

                <div class="col-auto">
                    <input type="submit" name="submit" value="Add Category" class="btn btn-success btn-lg">
                </div>

            </form>
            <!-- Add Category Form ends -->

            <?php

            // Check if submit button is clicked
            if (isset($_POST['submit'])) {
                // echo "clicked";

                // Get values from form
                $title = $_POST['title'];

                // For radio input, check if button is selected
                if (isset($_POST['featured'])) {
                    // Get value from form
                    $featured = $_POST['featured'];
                } else {
                    // Set default value
                    $featured = "No";
                }

                if (isset($_POST['active'])) {
                    // Get value from form
                    $active = $_POST['active'];
                } else {
                    // Set default value
                    $active = "No";
                }

                // Check if image is selected and set value of image name accordingly.
                // print_r($_FILES['image']);

                // die(); // Break code here

                if(isset($_FILES['image']['name']))
                {
                    // Upload image
                    // Image name, source and destination path to upload image
                    $image_name = $_FILES['image']['name'];

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
                        header('location'.SITEURL.'admin/add-category.php');
                        // Stop process
                        die();
                    }

                }
                else
                {
                    // Don't upload image and set image_name value as blank
                    $image_name="";
                }

                // Create query to insert category 
                $sql = "INSERT INTO tbl_category SET
                   title='$title',
                   image_name='$image_name',
                   featured='$featured',
                   active='$active' 
                   ";

                // Execute query
                $res = mysqli_query($conn, $sql);

                // Check if query executed and data inserted
                if ($res == true) {
                    // Query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                    // Redirect to manage category
                    header('location:' . SITEURL . 'admin/manage-category.php');
                } else {
                    // Failed to add
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                    // Redirect to manage category
                    header('location:' . SITEURL . 'admin/add-category.php');
                }
            }

            ?>

        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>