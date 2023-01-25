<html> 
<head> 
<meta charset="UTF-8"> 
<title>标签管理</title> 
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
		echo "标签列表<br/>";
        echo "共计".$rows."行 ".$colums."列<br/>";
		echo "tag ID | 标签名称 | 标签代号 | 标签描述 |";
        
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
            for($i=0; $i<$colums; $i++){
                echo "<td>$row[$i] |</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }


session_start (); 
if (isset ( $_SESSION ["code"] ))//判断code存不存在，如果不存在，说明异常登录
{
		    ShowTable("tag");
?>
	<a href="welcome.php">返回个人主页</a>
	<a href="add_tag.html">添加标签</a>
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

</body> 
</html> 