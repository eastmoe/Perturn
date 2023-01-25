<html> 
<head> 
<meta charset="UTF-8"> 
<title>管理用户</title> 
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
		echo "用户列表：";
		function ShowTable($table_name){ //PHP查询MySql数据库，将结果用表格输出
			$conn=mysqli_connect("localhost","root","123456");
			if(!$conn){
				echo "连接失败";
			}
			mysqli_select_db($conn,"site1");
			mysqli_query($conn,"set names utf8");
			$sql="select * from $table_name";
			$res=mysqli_query($conn,$sql);
			$rows=mysqli_affected_rows($conn);//获取行数
			$colums=mysqli_num_fields($res);//获取列数
			#echo "test数据库的"."$table_name"."表的所有用户数据如下：<br/>";
			echo "共计".$rows."个用户</br/>";
			echo "UID | 用户名 |";
        
			echo "<table><tr>";
			for($i=0; $i < $colums; $i++){
				#$field_name=mysqli_field_name($res,$i);
				$field_name=mysqli_fetch_field_direct($res,$i);
				#echo "<th>$field_name</th>";
				$value = @$field_name->return; #使用@禁止显示未定义的属性：标准类警告
				echo "<th> $value </th>";
			}
			echo "</tr>";
			while($row=mysqli_fetch_row($res)){
				echo "<tr>";
				for($i=0; $i<2; $i++){
					echo "<td>$row[$i] |</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}
		ShowTable("user");//显示用户列表
		$user_id_input=null;
		
		?>
<p></p>
	<form action="user_info.php" method="post" name="find_user_info"> 
  <!--onsubmit="return check()"-->
    用户ID：<input type="text" name="user_id_input" id="user_id_input"><br>
    <input type="submit" name="submit" value="管理"> 
	</form> 
  
<?php	
		echo "</br><a href='index.php'>返回面板首页</a>";
		mysqli_close($con);
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
