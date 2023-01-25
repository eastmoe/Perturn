<html> 
<head> 
<meta charset="UTF-8"> 
<title>~~~</title> 
</head> 
<body> 
<?php
session_start (); 
if (isset ( $_SESSION ["code"] ))//判断code存不存在，如果不存在，说明异常登录
{
	?>
	<script type="text/javascript"> 
	window.location.href="welcome.php"; //存在，跳转用户主页
	</script> 
	<?php
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
</body> 
</html>