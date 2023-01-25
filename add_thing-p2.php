<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
  <title>物品登记</title> 
</head> 
<body> 
  <?php 
	
	#$th_imgupload=$_FILES['th_imgup'];
    session_start(); 
	#var_dump($_FILES);
	#var_dump($_FILES['th_imgup']);
	
	
	$th_name=$_REQUEST["th_name"];
	$th_describe=$_REQUEST["th_describe"];
	$th_location=$_REQUEST["th_location"];
	$communication=$_REQUEST["communication"];
	$th_type=$_REQUEST["th_type"];
	$th_tag=$_REQUEST["thin_tag"];
	$upfile=$_FILES["th_imgup"];
	#$typelist=array("image/jpeg","image/jpg","image/png","image/gif");
    $path="./uploads/imgs/things/";//定义一个上传后的目录
	
if (isset ( $_SESSION ["code"] )) //判断code存不存在，如果不存在，说明异常登录 
{
		$username=$_SESSION["username"];
	
  
    $con=mysqli_connect("localhost","root","123456"); 
    if (!$con) { 
      die('数据库连接失败'.$mysql_error()); 
    } 
    mysqli_select_db($con,"site1"); 

	$dbuserresult=mysqli_query($con,"SELECT * FROM user WHERE username ='{$username}' AND isdelete =0;"); 
	 while ($userrow=mysqli_fetch_array($dbuserresult)) { 
      $adduserid=$userrow["uid"]; 
    }
	#查找匹配用户名的UID
	
	
	//3.本次上传文件大小的过滤（自己选择）
    #if($upfile['size']>100000){
    #    die("上传文件大小超出限制");
    #}
	//4.类型过滤
    #if(!in_array($upfile["type"],$typelist)){
    #    die("上传文件类型非法!".$upfile["type"]);
    #}
	
    //5.上传后的文件名定义(随机获取一个文件名)
	$fileinfo="";
    $fileinfo=pathinfo($upfile["name"]);//解析上传文件名字
    do{ 
        $new_file_name=date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];
    }while(file_exists($path.$new_file_name));
	
	//6.图片上传
	move_uploaded_file($upfile["tmp_name"],$path.$new_file_name);
	$thimg_inurl=$path.$new_file_name;
	#图片处理
	
	
	
	
    mysqli_query($con,"insert into things (name,things_describe,add_uid,location,type,communication,tag_about,img_path) values('{$th_name}','{$th_describe}','{$adduserid}','{$th_location}','{$th_type}','{$communication}','{$th_tag}','{$thimg_inurl}')") or die("存入数据库失败".mysqli_error()) ; 
	#保存到数据库
	

	
	
    mysqli_close($con); 
}




	else {
?> 
	<script type="text/javascript"> 
	alert("请先登录"); 
	window.location.href="exit.php"; 
	</script> 
<?php
	}
	

	

  ?> 
  <script type="text/javascript"> 
    alert("物品信息登记成功"); 
	window.location.href="welcome.php"; 
  </script> 
    
    
        
      
      
</body> 
</html>