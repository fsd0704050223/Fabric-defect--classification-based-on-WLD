<!doctype html> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
<title>��ӭ��¼����</title> 
</head> 
<body> 
  
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

    <table border="1">
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