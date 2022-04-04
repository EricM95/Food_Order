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
                    <input type="submit" name="submit" value="Update Category" class="btn btn-success btn-lg">
                </div>

            </form>

            </div>
        </div>
    </div>

<?php  include('partials/footer.php'); ?>