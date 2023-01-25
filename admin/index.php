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
		
		echo "<h3>后台-管理面板</h3>";
		$sql_u = "SELECT * FROM user";
		$r_result = mysqli_query($con,$sql_u);
		$row_numbers= mysqli_num_rows($r_result);
		echo "当前用户数量：".$row_numbers;
		#显示用户数
		$sql_th = "SELECT * FROM things";
		$th_result = mysqli_query($con,$sql_th);
		$th_numbers= mysqli_num_rows($th_result);
		echo "    当前物品数量：".$th_numbers;
		#显示物品数
		$sql_tag = "SELECT * FROM tag";
		$tag_result = mysqli_query($con,$sql_tag);
		$tag_numbers= mysqli_num_rows($tag_result);
		echo "    当前标签数量：".$tag_numbers;
		#显示标签数
		$mem_use=memory_get_usage();
		function format_bytes($size, $delimiter = '') { //函数处理数值
		$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
		for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
		return round($size, 2) . $delimiter ."&nbsp;".$units[$i];
}
		$mem_index=format_bytes($mem_use);
		echo "    内存占用：".$mem_index."<br/>";
		
		
		
		
		
		
		
		echo "</br><a href='user_admin.php'>用户管理</a>";
		echo "</br><a href='thin_admin.php'>物品管理</a>";
		echo "</br><a href='tag_admin.php'>标签管理</a>";
		echo "</br><a href='system.php'>系统信息</a>";
		echo "</br><a href='../welcome.php'>返回个人主页</a>";
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
