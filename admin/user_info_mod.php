<html> 
<head> 
<meta charset="UTF-8"> 
<title>账户操作中...</title> 
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
	mysqli_select_db($con,"site1");	
	$admin_user_search_result=mysqli_query($con,"SELECT * FROM user WHERE uid ='{$search_uid}';");  //查询user表确定登陆人
	while ($row=mysqli_fetch_array($admin_user_search_result)) { 
      $dbuser_admin_index=$row["admin_tag"]; 
    }
	if(is_null($dbuser_admin_index)){		
		?>
		<script type="text/javascript"> 
		alert("你不是管理员！"); 
		window.location.href="../welcome.php"; //不是管理员，跳转个人主页
		</script> 
		<?php		
	}
	else{
		
			$submit_uid=null; 
			$submit_name=null;
			$submit_mail=null;
			$submit_phone=null;
			$submit_disable=null;
			$submit_admin=null;
			$mod_uid=$_SESSION["temp_mod_user"];//从seesion获取需要修改的账户
			$submit_uid=$_POST["user_id"]; 
			$submit_name=$_POST["user_name"];
			$submit_mail=$_POST["user_mail"];
			$submit_phone=$_POST["user_phone"];
			$submit_disable=$_POST["user_disable"];
			$submit_admin=$_POST["user_admin"];//从表单获取需要修改的数据。
		
			function change_user_data($user_data_type,$change_data,$input_uid){
				$con=mysqli_connect("localhost","root","123456");
				mysqli_select_db($con,"site1");
				mysqli_query($con,"UPDATE user SET $user_data_type = '$change_data' WHERE uid = $input_uid;"); //用SQL执行修改语句
				mysqli_close($con);
				?>
				<script type="text/javascript"> 
				alert("修改成功！"); 
				window.location.href="user_admin.php"; //返回账户管理页
				</script> 
				<?php
			}//定义修改函数，传入参数为需要修改的字段，修改的值，UID
		
			if(!($submit_uid=="")){change_user_data('uid',$submit_uid,$mod_uid);}
			if(!($submit_name=="")){change_user_data('username',$submit_name,$mod_uid);}
			if(!($submit_mail=="")){change_user_data('mail',$submit_mail,$mod_uid);}
			if(!($submit_phone=="")){change_user_data('phone',$submit_phone,$mod_uid);}
			if(!($submit_disable=="")){change_user_data('isdelete',$submit_disable,$mod_uid);}
			if(!($submit_admin=="")){change_user_data('admin_tag',$submit_admin,$mod_uid);}
		}
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
</form>
</body> 
</html>
