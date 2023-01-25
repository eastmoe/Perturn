<html> 
<head> 
<meta charset="UTF-8"> 
<title>物品登记列表</title> 
</head> 
<body>
<?php

session_start ();//开启season会话
if (isset ( $_SESSION ["code"] ))//判断code存不存在，如果不存在，说明异常登录
{
	echo "<h3>您当前登记的物品</h3>";
	$con=mysqli_connect("localhost","root","123456"); 
    if (!$con) { 
      die('数据库连接失败'.$mysql_error()); 
    } 
    mysqli_select_db($con,"site1"); 
	$current_username=$_SESSION["username"];
	$current_userid=$_SESSION["uid"];//从session中取出当前的用户名和密码。
	$dbth_tid=null; 
	$dbth_name=null;
	$th_search_result=mysqli_query($con,"SELECT * FROM things WHERE add_uid ='{$current_userid}';"); //查询things表，找到与当前用户id匹配的添加用户id的物品
    while ($row=mysqli_fetch_array($th_search_result)) { 
		$dbth_tid=$row["tid"]; 
		$dbth_name=$row["name"];
		echo "<br/>物品ID：".$dbth_tid;
		echo " ；物品名称：".$dbth_name;
	}
?>
<p></p>
	<form action="show_things_info.php" method="post" enctype="multipart/form-data" name="find_th_info"> 
  <!--onsubmit="return check()"-->
  
    请输入要查看详细信息的物品ID：<input type="text" name="th_id_search" id="th_id_search"><br>
	
    <input type="submit" name="submit" value="提交"> 

  </form> 
  
  <form action="comp_reg.php" method="post" name="form_comp_register"
    onsubmit="return check()"> 
	<h3>完成登记</h3>
    物品ID<input type="text" name="compreg_thid" id="compreg_thid"><br>
	完成用户ID<input type="text" name="compreg_userid" id="compreg_userid"><br>
    <input type="submit" value="提交"> 
  
  </form> 
  
	  <a href="add_thing-p1.php">添加登记物品</a>
	<a href="welcome.php">返回个人主页</a>
<?php
mysqli_close($con);
}
else
{
?>

	<script type="text/javascript"> 
	alert("请先登录"); 
	window.location.href="login.html"; //不存在，跳转登陆页
	</script> 

<?php
}

?>
</body> 
</html>
