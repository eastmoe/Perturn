<html> 
<head> 
<meta charset="UTF-8"> 
<title>管理物品</title> 
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
				echo "物品登记列表<br/>";
				echo "共计".$rows."行 <br/>";
				echo "物品 ID | 物品名称 |";
        
				echo "<table><tr>";
				for($i=0; $i < 2; $i++){
					#$field_name=mysqli_field_name($res,$i);
					$field_name=mysqli_fetch_field_direct($res,$i);
					#echo "<th>$field_name</th>";
					$value = @$field_name->return; #使用@禁止显示未定义的属性：标准类警告
					echo "<th> $value </th>";
				}
				echo "</tr>";
				while($row=mysqli_fetch_row($res)){
					echo "<tr>";
					for($i=0; $i <2; $i++){
						echo "<td>$row[$i] |</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}
			ShowTable("things");
			mysqli_close($con);


	}
}
?>
<p></p>
	<form action="thin_info.php" method="post" enctype="multipart/form-data" name="find_th_info"> 
  <!--onsubmit="return check()"-->
  
    请输入要修改信息的物品ID：<input type="text" name="th_id_search" id="th_id_search"><br>
	
    <input type="submit" name="submit" value="提交"> 

  </form> 
		
		



</body> 
</html>