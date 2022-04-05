<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Manage Menu</h1>

            <a class="btn btn-primary my-4 fw-bold" href="<?php echo SITEURL; ?>admin/add-food.php">Add Food</a>

            <?php

            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            ?>

            <table class="table table-dark table-bordered my-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    // Query to get all food data
                    $sql = "SELECT * FROM tbl_food";

                    // Execute query
                    $res = mysqli_query($conn, $sql);

                    // Count rows to check if foods available or not
                    $count = mysqli_num_rows($res);

                    // Create number variable and set default value as 1
                    $sn=1;

                    if ($count > 0) 
                    {
                        // We have food in database
                        // Get foods from database and display
                        while ($row = mysqli_fetch_assoc($res)) 
                        {

                            // Get values from individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                    ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>£<?php echo $price; ?></td>
                                <td>
                                    <?php 
                                    
                                    // Check if image available or not
                                    if($image_name=="")
                                    {
                                        // We don't have image, display error message
                                        echo "<div class='error'>Image not added</div>";
                                    }
                                    else
                                    {
                                        // Image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="150px">
                                        <?php
                                    }
                                    
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a class="btn btn-success" href="#">Update Food</a>
                                    <a class="btn btn-danger" href="#">Delete Food</a>
                                </td>
                            </tr>

                    <?php

                        }
                    } 
                    else 
                    {
                        // None available
                        echo "<tr> <td class='error'> No food added yet </td> </tr>";
                    }

                    ?>


                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php') ?>