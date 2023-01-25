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
	mysqli_select_db($con,"site1");	
	$admin_user_search_result=mysqli_query($con,"SELECT * FROM user WHERE uid ='$search_uid';");  //查询user表确定登陆人
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
		
		
		/*
		#定义函数
			function  desable_accont($fuc_inner_uid)  {
				$con=mysqli_connect("localhost","root","123456");
				mysqli_select_db($con,"site1");	
				mysqli_query($con,"UPDATE user SET isdelete = '1' WHERE uid = $fuc_inner_uid';"); //用SQL禁用账户			
				unset( $_SESSION['temp_mod_user']);//删除记录被修改账户的临时seesion
				?>
				<!--<script type="text/javascript"> 
				alert("已禁用该账户"); 
				window.location.href="user_admin.php"; //返回账户管理页
				</script> -->
				<?php
				mysqli_close($con);	
			}//禁用账户函数 
						
			function  enable_accont($fuc_inner_uid) {
				$con=mysqli_connect("localhost","root","123456");
				mysqli_select_db($con,"site1");	
				mysqli_query($con,"UPDATE user SET isdelete = '0' WHERE uid = '$fuc_inner_uid';"); //用SQL启用账户	
				unset( $_SESSION['temp_mod_user']);//删除记录被修改账户的临时seesion	
				?>
				<!--<script type="text/javascript"> 
				alert("已启用该账户"); 
				window.location.href="user_admin.php"; //返回账户管理页
				</script> -->
				<?php
				mysqli_close($con);
			}//启用账户函数 
		
			function delete_warning(){
				if(confirm("确定要删除吗？")){
					alert('已确认删除');
					return 1;
				}else{
					return 0;
				}	
			}//删除确认弹框函数
		
		
			function  delete_accont($fuc_inner_uid){
				$d_au=delete_warning();
				if($d_qu>0){
					$con=mysqli_connect("localhost","root","123456");
					mysqli_select_db($con,"site1");	
					mysqli_query($con,"UPDATE user SET isdelete = '0' WHERE uid = '$fuc_inner_uid';"); //用SQL删除账户	
					unset( $_SESSION['temp_mod_user']);//删除记录被修改账户的临时seesion
					?>
					<script type="text/javascript"> 
					alert("已删除该账户"); 
					window.location.href="user_admin.php"; //返回账户管理页
					</script> 
					<?php
					mysqli_close($con);
				} 		
			}//删除函数
			
			
			function jump_to_mod_page(){
				?>
					<script type="text/javascript"> 
					window.location.href="user_info_mod.php"; //跳转账户信息修改页
					</script> 
				<?php
			}//修改函数
			*/

		$dbu_uid=null; 
		$dbu_name=null;
		$dbu_mail=null;
		$dbu_phone=null;
		$dbu_reg_time=null;
		$dbu_reg_ip=null;
		$dbu_disable=null;
		$dbu_admin=null;
		//定义变量
		
		$user_id_in=null;
		#$user_id_in=$_POST["user_id_input"];
		isset($_POST['user_id_input'])?$user_id_input = $_POST['user_id_input']:$user_id_input = NULL;
		$user_id_in=$user_id_input;

		$con=mysqli_connect("localhost","root","123456"); 
		if (!$con) { 
			die('数据库连接失败'.$mysql_error()); 
		} 
		mysqli_select_db($con,"site1"); 
		$user_search_result=mysqli_query($con,"SELECT * FROM user WHERE uid = '{$user_id_in}';"); //查询user表，找到对应的用户
		while ($row=mysqli_fetch_array($user_search_result)) { 
			$dbu_uid=$row["uid"]; 
			$dbu_name=$row["username"];
			$dbu_mail=$row["mail"];
			$dbu_phone=$row["phone"];
			$dbu_reg_time=$row["reg_time"];
			$dbu_reg_ip=$row["reg_ip"];
			$dbu_disable=$row["isdelete"];
			$dbu_admin=$row["admin_tag"];
		}
		$_SESSION["temp_mod_user"]=$dbu_uid; //创建临时session来存储需要修改信息的用户ID
		if(is_null($dbu_name)){ //用户名为空代表不存在
			?> 
			<script type="text/javascript"> 
			alert("用户不存在！"); 
			window.location.href="index.php"; 
			</script>
			<?php 
		}
		echo "<h3>用户 ".$dbu_name." 的信息</h3>";
		echo "<br/>UID：".$dbu_uid;
		echo "<br/>用户名：".$dbu_name;
		echo "<br/>邮件地址：".$dbu_mail;
		echo "<br/>电话：".$dbu_phone;
		echo "<br/>注册时间：".$dbu_reg_time;
		echo "<br/>注册IP：".$dbu_reg_ip;
		if(!is_null($dbu_admin)){echo "<br/>该用户是管理员";}else{echo "<br/>普通用户";}//显示用户身份
		if($dbu_disable>"0"){echo "<br/>账户已禁用";}elseif($dbu_disable<"1"){echo "<br/>账户状态正常";}//显示账户状态

		/*
		if(array_key_exists('disable_user', $_POST)) {
			mysqli_close($con);
			desable_accont($dbu_uid);
		}
		else if(array_key_exists('act_user', $_POST)) {
			mysqli_close($con);
			enable_accont($dbu_uid);
		}
		else if(array_key_exists('del_user', $_POST)) {
			mysqli_close($con);
			delete_accont($dbu_uid);
		}
		else if(array_key_exists('mod_user', $_POST)) {
			mysqli_close($con);
			jump_to_mod_page();
		}
		*/
	
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
<!--<form method="post">
<input type="submit" id="disable_user" name="disable_user" value="禁用账户"></button>
<input type="submit" id="act_user" name="act_user" value="启用账户"></button>
<input type="submit" id="del_user" name="del_user" value="删除账户"></button>
<input type="submit" id="mod_user" name="mod_user" value="修改账户信息"></button>
</form>-->

<h3>当前用户信息修改</h3>
<p>仅修改需要变动的信息，其余留空即可。修改“是否禁用账户”和“是否为管理员”时，1代表启用，0代表不启用。</p>
<form action="user_info_mod.php" method="post" name="user_info_mod"> 
  <!--onsubmit="return check()"-->
    用户ID：<input type="text" name="user_id" id="user_id"><br>
	用户名：<input type="text" name="user_name" id="user_name"><br>
	邮箱：<input type="text" name="user_mail" id="user_mail"><br>
	电话：<input type="text" name="user_phone" id="user_phone"><br>
	是否禁用账户：<input type="text" name="user_disable" id="user_disable"><br>
	是否为管理员：<input type="text" name="user_admin" id="user_admin"><br>
    <input type="submit" name="submit" value="提交"> 
</form> 
</br><a href='index.php'>返回面板首页</a>

</body> 
</html>