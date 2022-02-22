<!doctype html> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
<title>欢迎登录界面</title> 
</head> 
<body> 
  
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

    <table border="1">
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