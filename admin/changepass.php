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
                    <h1 class="page-header">Thay đổi mật khẩu ADMIN</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			
			
			
			
			

		<?php

if($_POST)
{

$oldword = $_POST["oldword"];
$newword = $_POST["newword"];
$newwword = $_POST["newwword"];

$oldmd = MD5($oldword);

$cpass = mysql_fetch_array(mysql_query("SELECT password FROM users WHERE id='".$uid."'"));


///////////////////////-------------------->> CURRENT PASS THIK ACHE TO?
if ($cpass[0]!=$oldmd){
$err1=1;
}

///////////////////////-------------------->> 2 bar ki same?
if ($newword!=$newwword){
$err2=1;
}

///////////////////////-------------------->> Pass ki faka??

 if(trim($newword)=="")
      {
$err3=1;
}

 if(strlen($newword)<=3)
      {
$err4=1;
}

$error = $err1+$err2+$err3+$err4;


if ($error == 0){
$passmd = MD5($newword);
$res = mysql_query("UPDATE users SET password='".$passmd."' WHERE id='".$uid."'");
if($res){
	echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Mật khẩu đã được thay đổi thành công!

</div>";
}else{
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Có lỗi trong quá trình xử lý, vui lòng thử lại!

</div>";
}
} else {
	
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Mật khẩu hiện tại không đúng.

</div>";
}		
if ($err2 == 1){
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Vui lòng nhập mật khẩu giống nhau ở cả 2 ô mật khẩu!

</div>";

}		
if ($err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Mật khẩu không thể để trống!!!

</div>";
echo"<h1></h1>";
}		
if ($err4 == 1){
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Mật khẩu phải có nhiều hơn 4 ký tự.

</div>";
}	

	
}



} 
	?>
			
			
			
			
			
			
			
			
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
				<form action="changepass.php" method="post">
		
                    <div class="form-group">
                        <input class="form-control" placeholder="Mật khẩu hiện tại" name="oldword" type="password">
                        <input class="form-control" placeholder="Mật khẩu mới" name="newword" type="password">
                        <input class="form-control" placeholder="Nhập lại mật khẩu mới" name="newwword" type="password">
                    </div>
					<input type="submit" class="btn btn-lg btn-success btn-block" value="Thay đổi">
				</form>
                </div>
                
                
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php
 include ('footer.php');
 ?>