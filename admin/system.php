<html> 
<head> 
<meta charset="UTF-8"> 
<title>管理面板</title> 
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
		
		echo "<h3>后台-系统信息</h3>";
		echo "系统：".php_uname()."<br/>";
		echo "服务器CPU：".$_SERVER['PROCESSOR_IDENTIFIER']."<br/>";
		echo "PHP运行方式：".php_sapi_name()."<br/>";
		echo "PHP进程用户：".Get_Current_User()."<br/>";
		echo "PHP版本：".PHP_VERSION."<br/>";
		echo "Zen版本：".Zend_Version()."<br/>";
		echo "PHP安装路径：".DEFAULT_INCLUDE_PATH."<br/>";
		echo "当前请求主机：".$_SERVER["HTTP_HOST"]."<br/>";
		echo "服务器IP地址：".GetHostByName($_SERVER['SERVER_NAME'])."<br/>";
		echo "客户端IP地址：".$_SERVER['REMOTE_ADDR']."<br/>";
		echo "服务器解译引擎：".$_SERVER['SERVER_SOFTWARE']."<br/>";
		echo "服务器语言：".$_SERVER['HTTP_ACCEPT_LANGUAGE']."<br/>";
		echo "服务器WEB端口：".$_SERVER['SERVER_PORT']."<br/>";
		$con = mysqli_connect("localhost", "root", "123456");
		echo "MySQL 服务器信息: " . mysqli_get_server_info($con)."<br/>";
		echo "</br><a href='index.php'>返回后台主页</a>";
		
		
		
		
		
		}
}
else
{
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
