<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="container">
        <div class="wrapper">
            <h1>Update Order</h1>

            <?php 
            
                // Check if id is set 
                if(isset($_GET['id']))
                {
                    // Get order details
                    $id = $_GET['id'];

                    // Get details from id
                    $sql = "SELECT * FROM tbl_order WHERE id=$id";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count == 1)
                    {
                        // Detail available
                        $row = mysqli_fetch_assoc($res);

                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $status = $row['status'];
                        $c_name = $row['customer_name'];
                        $c_contact = $row['customer_contact'];
                        $c_email = $row['customer_email'];
                        $c_address = $row['customer_address'];

                    }
                    else
                    {
                        // Details not available
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                }
                else
                {
                    // Redirect
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            
            ?>

            <div style="width: 60%;">
                <form  action="" method="POST" class="mt-4 ">
                    <div class="row mb-3">
                        <label class="col-sm-3">Food</label>
                        <div class="col-sm-9">
                            <p class="fw-bold"><?php echo $food; ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Price</label>
                        <div class="col-sm-9">
                            <p class="fw-bold">£<?php echo $price; ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Qty</label>
                        <div class="col-sm-9">
                        <input class="form-control" type="number" name="qty" value="<?php echo $qty; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Status</label>
                        <div class="col-sm-9">
                            <select class="form-select"  name="status">
                                <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                                <option <?php if($status=="Order Ready"){echo "selected";} ?> value="Order Ready">Order Ready</option>
                                <option <?php if($status=="Order Collected"){echo "selected";} ?> value="Order Collected">Order Collected</option>
                                <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Customer Name:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="customer_name" value="<?php echo $c_name; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Customer Contact:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="customer_contact" value="<?php echo $c_contact; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3">Customer Email:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="customer_email" value="<?php echo $c_email; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3">Customer Address:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" type="text" name="customer_address" value="" cols="30" rows="5"><?php echo $c_address; ?></textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input class="btn btn-success btn-lg" name="submit" type="submit" value="Update Order">
                    </div>

                </form>

                <?php 
                    // Check if update button is clicked
                    if(isset($_POST['submit']))
                    {
                       // echo "Clicked";
                       // Get values from form
                       $id = $_POST['id'];
                       $price = $_POST['price'];
                       $qty = $_POST['qty'];

                       $total = $price * $qty;

                       $status = $_POST['status'];

                       $c_name = $_POST['customer_name'];
                       $c_contact = $_POST['customer_contact'];
                       $c_email = $_POST['customer_email'];
                       $c_address = $_POST['customer_address'];

                       // Update values
                        $sql2 = "UPDATE tbl_order SET
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$c_name',
                        customer_contact = '$c_contact',
                        customer_email = '$c_email',
                        customer_address = '$c_address'
                        WHERE id = $id
                        ";

                        // Execute query
                        $res2 = mysqli_query($conn, $sql2);

                        // Check if updated
                       // Redirect to manage order
                       if($res2 == true)
                       {
                            $_SESSION['update'] = "<div class='success'>Order updated successfully</div>";
                            header('location:'.SITEURL.'admin/manage-order.php');
                       }
                       else
                       {
                        $_SESSION['update'] = "<div class='error'>Failed to update order</div>";
                        header('location:'.SITEURL.'admin/manage-order.php');
                       }
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>