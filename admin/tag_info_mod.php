<html> 
<head> 
<meta charset="UTF-8"> 
<title>标签信息处理中...</title> 
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
	$admin_user_search_result=mysqli_query($con,"SELECT * FROM user WHERE uid ='{$search_uid}';");  //查询user表确定登陆人
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
		$submit_tag_id=$_POST["in_tag_id"];
		$submit_tag_name=$_POST["in_tag_name"];
		$submit_tag_code=$_POST["in_tag_code"];
		$submit_tag_describe=$_POST["in_tag_dis"];
		$con=mysqli_connect("localhost","root","123456");
		mysqli_select_db($con,"site1");	
		$tag_id_search_result=mysqli_query($con,"SELECT * FROM tag WHERE tagid ='{$submit_tag_id}';");  //查询tag表确定存在
		while ($row=mysqli_fetch_array($tag_id_search_result)) { 
			$dbutag_name_index=$row["tag"]; 
		}
		if(is_null($dbutag_name_index)){		
			?>
			<script type="text/javascript"> 
			alert("标签ID不存在！"); 
			window.location.href="tag_admin.php"; //不是管理员，跳转个人主页
			</script> 
			<?php		
		}
		else{
			$mod_tag_id=$submit_tag_id;
			function change_data($data_type,$change_data,$input_id){
				$con=mysqli_connect("localhost","root","123456");
				mysqli_select_db($con,"site1");
				mysqli_query($con,"UPDATE tag SET $data_type = '$change_data' WHERE tagid = $input_id;"); //用SQL执行修改语句
				mysqli_close($con);
				?>
				<script type="text/javascript"> 
				alert("修改成功！"); 
				window.location.href="tag_admin.php"; //返回标签管理页
				</script> 
				<?php
			}//定义修改函数，传入参数为需要修改的字段，修改的值，UID
			if(!($submit_tag_name=="")){change_data('tag',$submit_tag_name,$mod_tag_id);}
			if(!($submit_tag_code=="")){change_data('tag_code',$submit_tag_code,$mod_tag_id);}
			if(!($submit_tag_describe=="")){change_data('tag_describe',$submit_tag_describe,$mod_tag_id);}

		}
		
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
</form>
</body> 
</html>		
		