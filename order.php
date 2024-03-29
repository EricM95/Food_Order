<?php include('partials-front/header.php'); ?>

    <?php 

        // Check if id is set
        if(isset($_GET['food_id']))
        {
            // Get food id
            $food_id = $_GET['food_id'];

            // Get details of selected food
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            // Check if data available
            if($count == 1)
            {
                // Get data
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];

            }
            else
            {
                // Food not available
                header('location:'.SITEURL);
            }

        }
        else
        {
            // Redirect to homepage
            header('location:'.SITEURL);
        }

    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            // Check if image available
                            if($image_name == "")
                            {
                                // Image not available
                                echo "<div class='error'>Image not available</div>";
                            }
                            else
                            {
                                // Image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">£<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="01234567890" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="test@email.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            
                // Check if submit button clicked
                if(isset($_POST['submit']))
                {
                    // Get values from form
                    $food = mysqli_real_escape_string($conn, $_POST['food']);
                    $price = mysqli_real_escape_string($conn, $_POST['price']);
                    $qty = mysqli_real_escape_string($conn, $_POST['qty']);

                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:i:sa");

                    $status = "Ordered";

                    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
                    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

                    // Save order in database
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true)
                    {
                        // Order saved
                        $_SESSION['order'] = "<div class='success text-center'>Order placed</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        // failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to place order</div>";
                        header('location:'.SITEURL);
                    }

                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>