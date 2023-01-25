<html> 
<head> 
<meta charset="UTF-8"> 
<title>用户信息</title> 

</head> 
<body>
<?php


session_start (); 
if (isset ( $_SESSION ["code"] ))//判断code存不存在，如果不存在，说明异常登录
{
	$search_uid=$_SESSION["uid"];
	$con=mysqli_connect("localhost","root","123456");
	if(!$con){
            echo "连接失败";
        }
		$submit_name=null;
		$submit_mail=null;
		$submit_phone=null;
		$my_uid=$_SESSION["uid"];//从seesion获取需要当前账户UID
		$submit_name=$_POST["user_name"];
		$submit_mail=$_POST["user_mail"];
		$submit_phone=$_POST["user_phone"]; //从表单获取需要修改的数据。
		
		function change_user_data($user_data_type,$change_data,$input_uid){
			$con=mysqli_connect("localhost","root","123456");
			mysqli_select_db($con,"site1");
			mysqli_query($con,"UPDATE user SET $user_data_type = '$change_data' WHERE uid = $input_uid;"); //用SQL执行修改语句
			mysqli_close($con);
			?>
			<script type="text/javascript"> 
			alert("修改成功！"); 
			window.location.href="welcome.php"; //返回账户管理页
			</script> 
			<?php
		}//定义修改函数，传入参数为需要修改的字段，修改的值，UID
		
		if(!($submit_name=="")){change_user_data('username',$submit_name,$my_uid);}
		if(!($submit_mail=="")){change_user_data('mail',$submit_mail,$my_uid);}
		if(!($submit_phone=="")){change_user_data('phone',$submit_phone,$my_uid);}		
	
}
else{
	?>
	<script type="text/javascript"> 
	alert("请先登录"); 
	window.location.href="exit.php"; //不存在，跳转登陆页
	</script> 
	<?php
}

?>		

</body> 
</html>		