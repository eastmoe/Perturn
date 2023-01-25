<html> 
<head> 
<meta charset="UTF-8"> 
<title>已登记的物品列表</title> 
</head> 
<body>
<?php
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



session_start ();//开启season会话
	if (isset ( $_SESSION ["code"] ))//判断code存不存在，如果不存在，说明异常登录
		{
			ShowTable("things");
					
			?>
			<p></p>
			<form action="show_things_info.php" method="post" enctype="multipart/form-data" name="find_th_info"> 
			<!--onsubmit="return check()"-->
			请输入要查看详细信息的物品ID：<input type="text" name="th_id_search" id="th_id_search"><br>
			<input type="submit" name="submit" value="提交"> 
			</form> 
			<a href="welcome.php">返回个人主页</a>
			<?php
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

    <script type="text/javascript"> 
    function check() { 
      var th_id_search=document.getElementById("th_id_search").value; 
      var regex=/^[/s]+$/; 
        
      if(regex.test(th_id_search)||th_id_search.length==0){ 
        alert("物品ID不能为空"); 
        return false; 
      } 
	  	  
    } 
	</script> 

</body> 
</html>
