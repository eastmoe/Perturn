<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
  <title>完成登记</title> 
</head> 
<body> 
  <?php 
  
  session_start (); 
if (isset ( $_SESSION ["code"] ))//判断code存不存在，如果不存在，说明异常登录
{
	 
    $comp_userid=$_REQUEST["compreg_userid"]; 
    $comp_tid=$_REQUEST["compreg_thid"]; 

    $con=mysqli_connect("localhost","root","123456"); 
    if (!$con) { 
      die('数据库连接失败'.$mysql_error()); 
    } 
    mysqli_select_db($con,"site1");  
    $user_search_result=mysqli_query($con,"SELECT * FROM user WHERE uid ='{$comp_userid}';"); 
    while ($row=mysqli_fetch_array($user_search_result)) { 
      $dbusername=$row["username"]; 
    } 
    if(is_null($dbusername)){ 
  ?> 
  <script type="text/javascript"> 
    alert("用户不存在"); 
    window.location.href="mythings.php"; 
  </script>  
  <?php 
    }
	#确定完成用户存在
	$thing_search_result=mysqli_query($con,"SELECT * FROM things WHERE tid ='{$comp_tid}';"); 
	while ($row=mysqli_fetch_array($thing_search_result)) { 
      $dbthingname=$row["name"]; 
    } 
    if(is_null($dbthingname)){ 
  ?> 
  <script type="text/javascript"> 
    alert("物品不存在"); 
    window.location.href="mythings.php"; 
  </script>  
  <?php 
    }	
	#确定物品是否存在
    mysqli_query($con,"UPDATE things SET comp_uid = '{$comp_userid}' WHERE tid = '{$comp_tid}'") or die("存入数据库失败".mysqli_error()) ; 
    mysqli_close($con); 
  ?> 
  <script type="text/javascript"> 
    alert("提交成功"); 
    window.location.href="mythings.php"; 
  </script> 
    
    
 <?php       
}
else
{
	?>
	<script type="text/javascript"> 
	alert("请先登录"); 
	window.location.href="exit.php"; 
	</script>
	<?php
}
?>    
</body> 
</html>