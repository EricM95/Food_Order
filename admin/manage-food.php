<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Manage Menu</h1>

            <a class="btn btn-primary my-4 fw-bold" href="<?php echo SITEURL; ?>admin/add-food.php">Add Food</a>

            <?php

            if (isset($_SESSION['add'])) 
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorized']))
            {
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
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
                                    <a class="btn btn-success" href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>">Update Food</a>
                                    <a class="btn btn-danger" href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>">Delete Food</a>
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