## Pre-Requisites:
Download and Install XAMPP for Windows version 7.4.29 / PHP 7.4.29

[Click Here to Download](https://www.apachefriends.org/download.html)

Install any Text Editor (Sublime Text or Visual Studio Code or Atom or Brackets)

## Installation
1. Download as as Zip or Clone this project
2. Move this project to Root Directory
3. Local Disk C: -> xampp -> htdocs -> 'this project'
4. Local Disk C is the location where xampp was installed

5. Open XAMPP Control Panel and Start 'Apache' and 'MySQL'

6. Import Database

a. Open 'phpmyadmin' in your browser b. Create a Database c. Import the SQL file provided with this project

Make Changes to settings
Go to 'config' folder and Open 'constants.php' file. Then make changes on following constants

```
<?php 
//Start Session
session_start();

//Create Constants to Store Non Repeating Values
define('SITEURL', 'http://localhost/Food_Order/'); //Update the home URL of the project if you have changed port number or it's live on server
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'db2_21815369');
    
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //SElecting Database 

?>
```
Now, Open the project in your browser. It should run perfectly.
