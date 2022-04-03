<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Manage Category</h1>

            <?php

            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            ?>

            <a class="btn btn-primary my-4 fw-bold" href="<?php echo SITEURL; ?>admin/add-category.php">Add Category</a>

            <table class="table table-dark table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    // Query to get all categories
                    $sql = "SELECT * FROM tbl_category";

                    // Execute query
                    $res = mysqli_query($conn, $sql);

                    // Count rows
                    $count = mysqli_num_rows($res);

                    // Create number variable and assign value as 1
                    $sn = 1;

                    // Check data in database
                    if ($count > 0) {

                        // Data in database
                        // Get and display data
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                    ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>

                                <td>
                                    <?php 
                                        // Check if image name is available
                                        if($image_name!="")
                                        {
                                            // Display image
                                            ?>

                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="150px">

                                            <?php
                                        }
                                        else
                                        {
                                            // Display message
                                            echo "<div class='error'>No image added</div>";
                                        }
                                    ?>
                                </td>

                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a class="btn btn-success" href="#">Update Category</a>
                                    <a class="btn btn-danger" href="#">Delete Category</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        // No data
                        // Display message inside table
                        ?>

                        <tr>
                            <td class="col-12">
                                <div class="error">No Categories Found</div>
                            </td>
                        </tr>

                    <?php
                    }

                    ?>



                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php') ?>