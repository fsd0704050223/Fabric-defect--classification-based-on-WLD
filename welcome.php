<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
<title>��ӭ��¼����</title>
</head>

<body>
<form action="" method="post">
 <p> �ļ����ң�ע�����ִ�Сд��</p>
 <p>���ң�<input type="text" name="key" /></p>
 <p><input type="submit" name="sub" value=" �� ʼ " /></p>
</form>
</body>

<body >
<?php
session_start ();
if (isset ( $_SESSION ["code"] )) {//�ж�code�治���ڣ���������ڣ�˵���쳣��¼
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
    <table border="5" style="border:5px solid red;background-color:#ffffff"><!--style�����ñ߿��С����ɫ������-->
      <thead>
        <tr>
          <td>�ļ���</td>
          <td>�ļ���С</td>
          <td>�ļ�����</td>
          <td>�޸�ʱ��</td>
        </tr>
      <thead>
      <tbody>
        <?php
        header("Content-Type:text/html; charset=gb2312");
        $url_this = "http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $handle = opendir($path);
        while($file=readdir($handle)){
          $file1=iconv('UTF-8', 'GB2312', $file);//�����ȡ�ļ���������������
          echo "<tr>";
          echo "<td>".$file1."</td>";
          echo "<td>".filesize($path."/".$file1)."</td>";
          if(filetype($path."/".$file1)=="dir"){
            $next = $pre_path."/".$file1;
            echo "<td><a href=\"$url_this?path=$next\">dir</a></td>";
          }else{
            echo "<td>".filetype($path."/".$file1)."</td>";
          }
          echo "<td>".date("Y��n��t��",filemtime($path."/".$file1))."</td>";
          echo "</tr>";
        }
        closedir($handle);
        ?>
      </tbody>
    </table>
<?php
/*
 * ע�����ִ�Сд
 */
header('Content-Type: text/html; charset=gb2312');
if(!empty($_POST['key'])){
	echo "��·�� ".$path."/ �в��� ".$_POST['key']." �Ľ��Ϊ��<hr/>";
	$file_num = $dir_num = 0;
	$r_file_num = $r_dir_num= 0;
	$findFile = iconv('GB2312','UTF-8', $_POST['key']);//������Ĳ�������������
	function delDirAndFile( $dirName ){
	 if ( $handle = @opendir( "$dirName" ) ) {
	  while ( false !== ( $item = readdir( $handle) ) ) {
		if ( $item != "." && $item != ".." ) {
		  if ( is_dir( "$dirName/$item" ) ) {
		  delDirAndFile( "$dirName/$item" );}
                  else {
			$GLOBALS['file_num']++;
			if(strstr($item,$GLOBALS['findFile'])){
			 $dirName1=iconv('UTF-8', 'GB2312', $dirName);//�����ȡ�ļ���������������
			 $item1=iconv('UTF-8', 'GB2312', $item);//�����ȡ�ļ���������������
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
			die("û�д�·����");
		}
	}
	delDirAndFile($path);
}
?>
<a href="exit.php">�˳���¼</a>
<?php
} else {//code�����ڣ�����exit.php �˳���¼
 ?>
<script type="text/javascript">
 alert("�˳���¼");
 window.location.href="exit.php";
</script>
<?php
}
?>
<br>
 <a href="alter_password.html">�޸�����</a>
</body>
</html>