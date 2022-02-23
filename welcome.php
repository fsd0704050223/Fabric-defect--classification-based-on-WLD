<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
<title>欢迎登录界面</title>
</head>

<body>
<form action="" method="post">
 <p> 文件查找（注：区分大小写）</p>
 <p>查找：<input type="text" name="key" /></p>
 <p><input type="submit" name="sub" value=" 开 始 " /></p>
</form>
</body>

<body >
<?php
session_start ();
if (isset ( $_SESSION ["code"] )) {//判断code存不存在，如果不存在，说明异常登录
 ?>

<?php
header("Content-Type:text/html; charset=gb2312");
if(isset($_GET['path'])){
  echo $path = $_SERVER['DOCUMENT_ROOT'].$_GET['path'];
  $pre_path = $_GET['path'];
}else{
  echo $path = $_SERVER['DOCUMENT_ROOT'];
  $pre_path = "";
}
?>
    <table border="5" style="border:5px solid red;background-color:#ffffff"><!--style中设置边框大小及颜色，背景-->
      <thead>
        <tr>
          <td>文件名</td>
          <td>文件大小</td>
          <td>文件类型</td>
          <td>修改时间</td>
        </tr>
      <thead>
      <tbody>
        <?php
        header("Content-Type:text/html; charset=gb2312");
        $url_this = "http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $handle = opendir($path);
        while($file=readdir($handle)){
          $file1=iconv('UTF-8', 'GB2312', $file);//解决读取文件名中文乱码问题
          echo "<tr>";
          echo "<td>".$file1."</td>";
          echo "<td>".filesize($path."/".$file1)."</td>";
          if(filetype($path."/".$file1)=="dir"){
            $next = $pre_path."/".$file1;
            echo "<td><a href=\"$url_this?path=$next\">dir</a></td>";
          }else{
            echo "<td>".filetype($path."/".$file1)."</td>";
          }
          echo "<td>".date("Y年n月t日",filemtime($path."/".$file1))."</td>";
          echo "</tr>";
        }
        closedir($handle);
        ?>
      </tbody>
    </table>
<?php
/*
 * 注：区分大小写
 */
header('Content-Type: text/html; charset=gb2312');
if(!empty($_POST['key'])){
	echo "在路径 ".$path."/ 中查找 ".$_POST['key']." 的结果为：<hr/>";
	$file_num = $dir_num = 0;
	$r_file_num = $r_dir_num= 0;
	$findFile = iconv('GB2312','UTF-8', $_POST['key']);//解决中文不能收缩的问题
	function delDirAndFile( $dirName ){
	 if ( $handle = @opendir( "$dirName" ) ) {
	  while ( false !== ( $item = readdir( $handle) ) ) {
		if ( $item != "." && $item != ".." ) {
		  if ( is_dir( "$dirName/$item" ) ) {
		  delDirAndFile( "$dirName/$item" );}
                  else {
			$GLOBALS['file_num']++;
			if(strstr($item,$GLOBALS['findFile'])){
			 $dirName1=iconv('UTF-8', 'GB2312', $dirName);//解决读取文件名中文乱码问题
			 $item1=iconv('UTF-8', 'GB2312', $item);//解决读取文件名中文乱码问题
			echo " <span><b> $dirName1/$item1 </b></span><br />\n";
			$GLOBALS['r_file_num']++;
			}
    	          }
                 }
               }
	closedir( $handle);
	$GLOBALS['dir_num']++;
	if(strstr($dirName1,$GLOBALS['findFile'])){
	   $loop = explode($GLOBALS['findFile'],$dirName1);
	   $countArr = count($loop)-1;
	   if(empty($loop[$countArr])){
		echo " <span style='color:#297C79;'><b> $dirName1 </b></span><br />\n";
		$GLOBALS['r_dir_num']++;				}
		}
		}else{
			die("没有此路径！");
		}
	}
	delDirAndFile($path);
}
?>
<a href="exit.php">退出登录</a>
<?php
} else {//code不存在，调用exit.php 退出登录
 ?>
<script type="text/javascript">
 alert("退出登录");
 window.location.href="exit.php";
</script>
<?php
}
?>
<br>
 <a href="alter_password.html">修改密码</a>
</body>
</html>