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
 //connectdb();
 connectdbbus();
 include ('header.php');
 $error = 0;
 $err1 = 0;
 $err2 = 0;
 ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm TUYẾN XE Mới</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                <div class="col-md-10 col-md-offset-1">
				
		<?php

if($_POST)
{

$fname = $_POST["fname"];
$tname = $_POST["tname"];

 if(trim($fname)=="")
      {
	$err1=1;
	}
if(trim($tname)=="")
      {
$err2=1;
}

$error = $err1+$err2 ;

if ($error == 0){

//$query = "INSERT INTO `mst_route` (`startpoint`, `endpoint`) VALUES ('$fname', '$tname')";
//$query1 = "SELECT * FROM table WHERE mystring='".$string1."'";
$res = mysql_query("INSERT INTO `mst_route` (`id`,`startpoint`, `endpoint`) VALUES ('RT-0000009','$fname', '$tname')");
//mysql_query("INSERT INTO 'mst_route'('startpoint','endpoint') VALUES('".$fname."', '".$tname."')");

if($res){
	echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Thêm tuyến xe mới thành công!

</div>";

}else{
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Có lỗi xảy ra. Vui lòng thử lại.

</div>";
}
} else {
	
	
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Nơi đi không thể để trống!!!

</div>";
echo"<h1></h1>";
}	

if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Nơi đến không thể để trống!!!

</div>";
echo"<h1></h1>";
}

}
} 
	?>
					
				    <form action="routeadd.php" method="post">
		
                    <div class="form-group">
					
					<label>Nơi Đi</label><input class="form-control" placeholder="Nơi Đi" name="fname" type="text"><br/>
				    <label>Nơi Đến</label><input class="form-control" placeholder="Nơi Đến" name="tname" type="text"><br/>
					
					</div>
					<input type="submit" class="btn btn-lg btn-success btn-block" value="THÊM MỚI">
			    	</form>
                </div>
				
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php
 include ('footer.php');
 ?>