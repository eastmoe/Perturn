<html> 
<head> 
<meta charset="UTF-8"> 
  <title>物品信息</title> 
</head> 
<body> 
  <?php 
  
session_start (); 
if (isset ( $_SESSION ["code"] ))//判断code存不存在，如果不存在，说明异常登录
{
	$input_id=$_REQUEST["th_id_search"];
	$con=mysqli_connect("localhost","root","123456"); 
    if (!$con) { 
      die('数据库连接失败'.$mysql_error()); 
    } 
    mysqli_select_db($con,"site1"); 
    $dbth_tid=null; 
	$dbth_name=null;
	$dbth_describe=null;
	$dbth_type=null;
	$dbth_add_uid=null;
	$dbth_add_username=null;
	$dbth_compuid=null;
	$comp_status=null;
	$dbth_compusername=null;
	$dbth_tagsid=null;
	$dbth_tagname=null;
	$dbth_location=null;
	$dbth_time=null;
	$dbth_communication=null;
    $dbth_imgpath=null; 
	#定义变量
    $th_search_result=mysqli_query($con,"SELECT * FROM things WHERE tid ='{$input_id}';"); //查询things表
    while ($row=mysqli_fetch_array($th_search_result)) { 
		$dbth_tid=$row["tid"]; 
		$dbth_name=$row["name"];
		$dbth_describe=$row["things_describe"];
		$dbth_type=$row["type"];
		$dbth_add_uid=$row["add_uid"];
		$dbth_compuid=$row["comp_uid"];
		$dbth_tagsid=$row["tag_about"];
		$dbth_location=$row["location"];
		$dbth_time=$row["time"];
		$dbth_communication=$row["communication"];
		$dbth_imgpath=$row["img_path"]; 
    } 
    if(is_null($dbth_tid)){ //物品id为空代表不存在该物品
  ?> 
  <script type="text/javascript"> 
    alert("物品id不存在！"); 
    window.location.href="index.php"; 
  </script>  
  <?php 
	}
  $adduser_search_result=mysqli_query($con,"SELECT * FROM user WHERE uid ='{$dbth_add_uid}';");  //查询user表确定发布人
  while ($row=mysqli_fetch_array($adduser_search_result)) { 
      $dbth_add_username=$row["username"]; 
    }
	
  $compuser_search_result=mysqli_query($con,"SELECT * FROM user WHERE uid ='{$dbth_compuid}';");  //查询user表确定完成人
  while ($row=mysqli_fetch_array($compuser_search_result)) { 
	  $dbth_compusername=$row["username"];
  }
	if (is_null($dbth_compusername)){ //当完成人为空代表未完成
		$comp_status="未完成";
		$dbth_compusername="不存在";
	}
	else{
		$comp_status="已完成";
    }
	
	
  #创建人与完成人

	
	echo "<h3>物品详情页</h3>";
	echo "<br/>物品ID：".$dbth_tid;
	echo "<br/>物品名称：".$dbth_name;
	echo "<br/>物品描述：".$dbth_describe;
	echo "<br/>类型：".$dbth_type;
	echo "<br/>添加人：".$dbth_add_username;
	echo "<br/>状态：".$comp_status;
	echo "<br/>完成人：".$dbth_compusername;
	echo "<br/>位置：".$dbth_location;
	echo "<br/>添加时间：".$dbth_time;
	echo "<br/>联系方式：".$dbth_communication;
	#直接输出的信息
	echo "<br/>物品标签：";	
	if (is_null($dbth_tagsid)){ //如果tagid列表为空，则直接输出无
		echo "无";
	}
	else{
		$th_tag_array=explode(',',$dbth_tagsid);//用逗号将tagid分割成数组
		$th_tag_count=count($th_tag_array);//记录tag id数组的长度
		for($i=0;$i<$th_tag_count;$i++){
			$th_tag_search_result=mysqli_query($con,"SELECT * FROM tag WHERE tagid ='{$th_tag_array[$i]}';");  //对应tagid数组，分别查询tag表确定标签
			while ($row=mysqli_fetch_array($th_tag_search_result)) { 
				$dbth_tagname=$row["tag"];
				echo $dbth_tagname;
				echo "；";
		}
	}
	}
	
	
	echo "<br/>图片：";
	if(is_null($dbth_imgpath)){
		echo "不存在(未上传)";
	}
	else{
		echo "<br/><img src=".$dbth_imgpath."><br/>";
	}
	#显示图片
	mysqli_close($con); 


	?>
	
	<a href="welcome.php">返回个人主页</a>
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