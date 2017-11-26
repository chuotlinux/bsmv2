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


    

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thay Đổi TUYẾN XE</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                <div class="col-md-10 col-md-offset-1">
				
				
	

		<?php

if($_POST)
{

$cid = $_POST["cid"];
$rname = $_POST["rname"];

$err1=0;
 if(trim($rname)=="")
      {
$err1=1;
}


$error = $err1;


if ($error == 0){

$res = mysql_query("UPDATE bus_route SET routename='".$rname."' WHERE id='".$cid."'");
if($res){
	echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Thay đổi tuyến thành công!

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

Tên tuyến không thể để trống!!!

</div>";
echo"<h1></h1>";
}		
	

	
}



} 
	?>
							
				
				
				
				
				
				
				
				
<?php
$cid = $_GET["cid"];				
		echo "		    <form action=\"routeedit.php?cid=$cid\" method=\"post\">
		            <div class=\"form-group\">";

$details = mysql_fetch_array(mysql_query("SELECT routename FROM bus_route WHERE id='".$cid."'"));
echo "
					<label>Tên Tuyến</label><input class=\"form-control\" value=\"$details[0]\" name=\"rname\" type=\"text\"><br/>
					<input type=\"hidden\" name=\"cid\" value=\"$cid\">
";
?>                    
					</div>
					<input type="submit" class="btn btn-lg btn-success btn-block" value="THAY ĐỔI">
			    	</form>
                </div>
						
						
						
						
						
				
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


<?php
 include ('footer.php');
 ?>