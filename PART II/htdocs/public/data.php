<?php require_once('../private/initialize.php') ?>

<?php 
echo "sb";
$dbhost = 'localhost';
$dbuser = 'staff1';
$dbpass = 'staff1pswd';
$dbname = 'mysql';
$sql_u = "SELECT * FROM user";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = 'SELECT * FROM customer';
$result_set = mysqli_query($connection, $sql_u);
if (mysqli_num_rows($result_set) > 0) {
  	  echo ("Sorry... username already taken");
 } else {
 	echo ("cant find");
 } 
header( "Refresh:5; url=http://www.example.com/page2.php");

$ss = mysqli_fetch_row($result_set);

mysqli_free_result($result_set);
echo $ss[0];
echo "<br>";



?>