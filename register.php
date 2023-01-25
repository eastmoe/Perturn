<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
  <title>注册用户</title> 
</head> 
<body> 
  <?php 
    session_start(); 
    $username=$_REQUEST["username"]; 
    $password=$_REQUEST["password"]; 
	$passhash = password_hash($password, PASSWORD_DEFAULT);
	#使用password_hash对密码加密，输出为$passhash
	$mail=$_REQUEST["mail"]; 
	$phone=$_REQUEST["phone"]; 
	
	$regip = $_SERVER["REMOTE_ADDR"];#获取注册ip
  
    $con=mysqli_connect("localhost","root","123456"); 
    if (!$con) { 
      die('数据库连接失败'.$mysql_error()); 
    } 
    mysqli_select_db($con,"site1"); 
    $dbusername=null; 
    $dbpassword=null; 
    $result=mysqli_query($con,"SELECT * FROM user WHERE username ='{$username}' AND isdelete =0;"); 
    while ($row=mysqli_fetch_array($result)) { 
      $dbusername=$row["username"]; 
    } 
    if(!is_null($dbusername)){ 
  ?> 
  <script type="text/javascript"> 
    alert("用户已存在"); 
    window.location.href="register.html"; 
  </script>  
  <?php 
    } 
    mysqli_query($con,"insert into user (username,password,mail,phone,reg_ip) values('{$username}','{$passhash}','{$mail}','{$phone}','{$regip}')") or die("存入数据库失败".mysqli_error()) ; 
    mysqli_close($con); 
  ?> 
  <script type="text/javascript"> 
    alert("注册成功"); 
    window.location.href="login.html"; 
  </script> 
    
    
        
      
      
</body> 
</html>