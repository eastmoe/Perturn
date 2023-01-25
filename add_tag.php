<html> 
<head> 
<meta charset="UTF-8"> 
<title>标签管理</title> 
</head> 
<body> 
<?php
session_start(); 
if (isset ( $_SESSION ["code"] ))//判断code存不存在，如果不存在，说明异常登录
{
	$tag_name=$_REQUEST["tag_name"];
	$tag_code=$_REQUEST["tag_code"];
	$tag_describe=$_REQUEST["tag_describe"];
	
	$con=mysqli_connect("localhost","root","123456"); 
    if (!$con) { 
      die('数据库连接失败'.$mysql_error()); 
    } 
    mysqli_select_db($con,"site1"); 
	mysqli_query($con,"insert into tag (tag,tag_code,tag_describe) values('{$tag_name}','{$tag_code}','{$tag_describe}')") or die("存入数据库失败".mysqli_error()) ; 
    mysqli_close($con); 

}
else
{
	?>
	<script type="text/javascript"> 
	window.location.href="login.html"; //不存在，跳转登陆页
	</script> 
	<?php
}

?> 

  <script type="text/javascript"> 
    alert("登记成功"); 
    window.location.href="tag.php"; 
  </script> 


</body> 
</html>	
