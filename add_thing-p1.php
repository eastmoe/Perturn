<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
<title>物品登记</title> 
<style type="text/css"> 
form { 
  text-align: center; 
} 
</style> 
</head> 
<body> 
  
  <form action="add_thing-p2.php" method="post" enctype="multipart/form-data" name="form_register"> 
  <!--onsubmit="return check()"-->
    物品名：<input type="text" name="th_name" id="th_name"><br>
	描述：<input type="text" name="th_describe" id="th_describe"><br>
	初始位置：<input type="text" name="th_location" id="th_location"><br>
    联系方式：<input type="text" name="communication" id="communication"><br> 
	物品标签：<input type="text" name="thin_tag" id="thin_tag"><br>
	
	<div class="col-12 mt-2">
	<label for="" class="">物品类型：</label>
	<input type="radio" name="th_type" value="矢主寻物" />
	<label for="carefulOrPass" class="">矢主寻物</label>
	<input type="radio" name="th_type" value="拾物寻主" />
	<label for="rollbackRevise" class="">拾物寻主</label>
	</div>
	<p>输入的标签，请使用标签ID。具体表参见标签列表，添加多个标签请使用英文逗号,分隔ID。</p>

	<h3>图片上传</h3>
	<p>您可以上传一张图片作为物品的补充资料</p>
	<!-- 文件上传得form表单 -->
	上传图片:
	<input type="file" name="th_imgup" id="th_imgup">
	
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
  
  <a href="welcome.php">返回个人主页</a>
  <script type="text/javascript"> 
    function check() { 
      var th_name=document.getElementById("th_name").value; 
      var communication=document.getElementById("communication").value; 
	  var th_type=document.getElementById("th_type").value;
      var regex=/^[/s]+$/; 
        
      if(regex.test(th_name)||th_name.length==0){ 
        alert("物品名称不能为空"); 
        return false; 
      } 
	 
      if(regex.test(communication)||communication.length==0){ 
        alert("联系方式不能为空"); 
        return false;     
      } 

      if(regex.test(th_type)||th_type.length==0){ 
        alert("请选择物品登记类型"); 
        return false; 
      } 	  
    } 
  </script> 
</body> 
</html>