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
	$search_uid=$_SESSION["uid"];
	$con=mysqli_connect("localhost","root","123456");
	if(!$con){
            echo "连接失败";
        }
	mysqli_select_db($con,"site1");	
	$admin_user_search_result=mysqli_query($con,"SELECT * FROM user WHERE uid ='$search_uid';");  //查询user表确定登陆人
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
		//定义变量
		
		#$$input_id=null;
		isset($_POST['th_id_search'])?$th_id_search = $_POST['th_id_search']:$th_id_search = NULL;
		$th_id_search;
		
		$th_search_result=mysqli_query($con,"SELECT * FROM things WHERE tid ='{$th_id_search}';"); //查询things表
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
			window.location.href="thin_admin.php"; 
			</script> 
			<?php 
		}
		$_SESSION["temp_mod_thing"]=$dbth_tid; //创建临时session来存储需要修改信息的物品ID
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

	
		echo "<h3>物品信息修改</h3>";
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
			echo "<br/><img src=.".$dbth_imgpath."><br/>";
		}
		#显示图片
		mysqli_close($con); 


	
	}
}
else{
	?>
	<script type="text/javascript"> 
	alert("请先登录"); 
	window.location.href="exit.php"; //不存在，跳转登陆页
	</script> 
	<?php
}

?>


<h3>物品信息修改</h3>
<p>仅修改需要变动的信息，其余留空即可。修改“标签”时请使用标签ID。</p>
<form action="thin_info_mod.php" method="post" enctype="multipart/form-data" name="thin_info_mod"> 
  <!--onsubmit="return check()"-->
    物品ID：<input type="text" name="in_tid" id="in_tid"><br>
	物品名：<input type="text" name="in_tname" id="in_tname"><br>
	物品描述：<input type="text" name="in_tdis" id="in_tdis"><br>
	<div class="col-12 mt-2">
	<label for="" class="">物品类型：</label>
	<input type="radio" name="th_type" value="矢主寻物" />
	<label for="carefulOrPass" class="">矢主寻物</label>
	<input type="radio" name="th_type" value="拾物寻主" />
	<label for="rollbackRevise" class="">拾物寻主</label>
	</div>
	添加人：<input type="text" name="in_tadd_uid" id="in_tadd_uid"><br>
	完成人：<input type="text" name="in_tcomp_uid" id="in_tcomp_uid"><br>
	位置：<input type="text" name="in_tloc" id="in_tloc"><br>
	联系方式：<input type="text" name="in_commu" id="in_commu"><br>
	标签：<input type="text" name="in_tag" id="in_tag"><br>
	替换描述图片:
	<input type="file" name="in_thimgup" id="in_thimgup">
    <input type="submit" name="submit" value="提交"> 
</form> 

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
	
	echo "<h3>可用标签列表<br/></h3>";
	ShowTable("tag");
	


?>  

</br><a href='index.php'>返回面板首页</a>

</body> 
</html>