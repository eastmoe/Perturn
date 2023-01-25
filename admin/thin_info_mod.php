<html> 
<head> 
<meta charset="UTF-8"> 
<title>物品操作中...</title> 
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
		
			$submit_tid=null; 
			$submit_tname=null;
			$submit_tdis=null;
			$submit_ttype=null;
			$submit_tadduid=null;
			$submit_tcompuid=null;
			$submit_tloc=null;
			$submit_tcomm=null;
			$submit_ttag=null;
			$mod_tid=$_SESSION["temp_mod_thing"];//从seesion获取需要修改的物品
			$submit_tid=$_POST['in_tid']; 
			$submit_tname=$_POST['in_tname'];
			$submit_tdis=$_POST['in_tdis'];
			isset($_POST['th_type'])?$th_type = $_POST['th_type']:$th_type = NULL;
			$submit_ttype=$th_type;
			$submit_tadduid=$_POST['in_tadd_uid'];
			$submit_tcompuid=$_POST['in_tcomp_uid'];
			$submit_tloc=$_POST['in_tloc'];
			$submit_tcomm=$_POST['in_commu'];
			$submit_ttag=$_POST['in_tag'];
			#$submit_upfile=$_FILES['in_thimgup'];
			isset($_FILES['in_thimgup'])?$in_thimgup = $_FILES['in_thimgup']:$in_thimgup = NULL;
			$submit_upfile=$in_thimgup;//从表单获取需要修改的数据。
		
			function change_data($data_type,$change_data,$input_id){
				$con=mysqli_connect("localhost","root","123456");
				mysqli_select_db($con,"site1");
				mysqli_query($con,"UPDATE things SET $data_type = '$change_data' WHERE tid = $input_id;"); //用SQL执行修改语句
				mysqli_close($con);
				?>
				<script type="text/javascript"> 
				alert("修改成功！"); 
				window.location.href="thin_admin.php"; //返回物品管理页
				</script> 
				<?php
			}//定义修改函数，传入参数为需要修改的字段，修改的值，UID
		
			if(!($submit_tid=="")){change_data('tid',$submit_tid,$mod_tid);}
			if(!($submit_tname=="")){change_data('name',$submit_tname,$mod_tid);}
			if(!($submit_tdis=="")){change_data('things_describe',$submit_tdis,$mod_tid);}
			if(!($submit_ttype=="")){change_data('type',$submit_ttype,$mod_tid);}
			if(!($submit_tadduid=="")){change_data('add_uid',$submit_tadduid,$mod_tid);}
			if(!($submit_tcompuid=="")){change_data('comp_uid',$submit_tcompuid,$mod_tid);}
			if(!($submit_tloc=="")){change_data('location',$submit_tloc,$mod_tid);}
			if(!($submit_tcomm=="")){change_data('communication',$submit_tcomm,$mod_tid);}
			if(!($submit_ttag=="")){change_data('tag_about',$submit_ttag,$mod_tid);}
			if($submit_upfile['size']!=0){
				$path="../uploads/imgs/things/";//定义一个上传后的目录
				//5.上传后的文件名定义(随机获取一个文件名)
				$fileinfo="";
				$fileinfo=pathinfo($submit_upfile["name"]);//解析上传文件名字
				do{ 
					$new_file_name=date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];
				}
				while(file_exists($path.$new_file_name));	
				//6.图片上传
				move_uploaded_file($submit_upfile["tmp_name"],$path.$new_file_name);
				$new_thimg_inurl="./uploads/imgs/things/".$new_file_name;//访问路径差异，不能使用“../”
				#图片处理				
				change_data('img_path',$new_thimg_inurl,$mod_tid);//保存新的图片URL到数据库
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
<script type="text/javascript"> 
	window.location.href="thin_admin.php"; //返回物品管理页
</script> 
</form>
</body> 
</html>
