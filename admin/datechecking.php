<?php
require_once('function.php');
connectdbuser();
session_start();

if (!is_user()) {
	redirect('index.php');
}

?>

<?php
 $user = $_SESSION['username'];
 $usid = mysql_fetch_array(mysql_query("SELECT id FROM mst_user WHERE username='".$user."'"));
 $uid = $usid[0];
 connectdb();
 include ('header.php');
 ?>
<?php
 include ('datechecking1.php'); 
 ?>
<?php
 include ('footer.php');
 ?>