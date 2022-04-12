<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="container-">
        <div class="wrapper">
            <h1>Manage Orders</h1>

            <?php 
            
                if(isset($_SERVER['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            
            ?>

            <table class="table table-dark table-bordered mt-4 w-auto table-responsive justify-content-center">
                <thead>
                    <tr>
                        <th>Order No.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                
                        // Get orders from database
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // Display latest order first
                        
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        if($count>0)
                        {
                            // Order available
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // Get order details
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $c_name = $row['customer_name'];
                                $c_contact = $row['customer_contact'];
                                $c_email = $row['customer_email'];
                                $c_address = $row['customer_address'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php  
                                                // Ordered, Order Ready, Order Collected, Cancelled
                                                if($status == "Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status == "Order Ready")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status == "Order Collected")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status == "Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $c_name; ?></td>
                                        <td><?php echo $c_contact; ?></td>
                                        <td><?php echo $c_email; ?></td>
                                        <td><?php echo $c_address; ?></td>
                                        <td>
                                            <a class="btn btn-success" href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>">Update Order</a>
                                        </td>
                                    </tr>
                                <?php 
                            }

                        }
                        else
                        {
                            // Order not available
                            echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
                        }
                
                    ?>  
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php') ?>