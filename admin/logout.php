<?php
    // Include constants for siteurl
    include('../config/constants.php');
    
    // Destroy session
    session_destroy(); // Unsets $_SESSION['user']

    // Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>