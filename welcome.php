<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
<title>用户主页</title> 
</head> 
<body> 
  
<?php
session_start (); 
if (isset ( $_SESSION ["code"] )) {//判断code存不存在，如果不存在，说明异常登录 

	$dbu_mail=null;
	$dbu_phone=null;
	$dbu_reg_time=null;
	$dbu_reg_ip=null;
	$dbu_disable=null;
	$dbu_admin=null;
	$my_uid=$_SESSION["uid"];
	$con=mysqli_connect("localhost","root","123456");
	if (!$con) { 
			die('数据库连接失败'.$mysql_error()); 
		} 
		mysqli_select_db($con,"site1"); 
		$user_search_result=mysqli_query($con,"SELECT * FROM user WHERE uid = '{$my_uid}';"); //查询user表，找到对应的用户
		while ($row=mysqli_fetch_array($user_search_result)) { 
			$dbu_mail=$row["mail"];
			$dbu_phone=$row["phone"];
			$dbu_reg_time=$row["reg_time"];
			$dbu_reg_ip=$row["reg_ip"];
			$dbu_disable=$row["isdelete"];
			$dbu_admin=$row["admin_tag"];
		}
	

	
  ?> 
欢迎登录，<?php
  echo "{$_SESSION["username"]}";//显示登录用户名 
  ?><br> 
  
您的UID：<?php
  echo "{$_SESSION["uid"]}";//显示登录用户ID 
  ?> 
  
  <?php
	echo "<br/>邮件地址：".$dbu_mail;
	echo "<br/>电话：".$dbu_phone;
	echo "<br/>注册时间：".$dbu_reg_time;
	echo "<br/>注册IP：".$dbu_reg_ip;
	if(!is_null($dbu_admin)){echo "<br/>您是管理员";}else{echo "<br/>您是普通用户";}//显示用户身份
	//if($dbu_disable>"0"){echo "<br/>账户已禁用";}elseif($dbu_disable<"1"){echo "<br/>账户状态正常";}//显示账户状态

  ?>
  
  
  
<br/>您的IP位置：<?php
  echo "{$_SERVER['REMOTE_ADDR']}";//显示ip 
  ?> 
<br> 
您的语言： 
<?php
  echo "{$_SERVER['HTTP_ACCEPT_LANGUAGE']}";//使用的语言 
  ?> 
<br> 
您的浏览器版本： 
<?php
  echo "{$_SERVER['HTTP_USER_AGENT']}";//浏览器版本信息 
  ?> 
<?php
} else {//code不存在，调用exit.php 退出登录 
  ?> 
<script type="text/javascript"> 
  alert("请先登录"); 
  window.location.href="exit.php"; 
</script> 
<?php
} 
?> 
<br> 
  <a href="alter_password.html">修改密码</a> 
  <a href="alter_user_info.html">修改个人资料</a> 
  <a href="exit.php">退出登录</a> 
  <a href="thingslists.php">查看所有物品</a>
  <a href="mythings.php">查看我登记的物品</a>
  <a href="tag.php">查看标签</a>
<?php
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
	if(!is_null($dbuser_admin_index)){
		echo "<a href='./admin/index.php'>进入后台</a>";
	}
 
?>  
  
</body> 
</html> 