<!doctype html> 
<html> 
<head> 
<meta charset="gb2312"> 
<title>��ӭ��¼����</title> 
</head> 
<body> 
  
<?php
 header('Content-Type: text/html; charset=gb2312');
session_start (); 
if (isset ( $_SESSION ["code"] )) {//�ж�code�治���ڣ���������ڣ�˵���쳣��¼ 
 ?> 
��ӭ��¼<?php
 echo "${_SESSION["username"]}";//��ʾ��¼�û��� 
 ?><br> 
����ip��<?php
 echo "${_SERVER['REMOTE_ADDR']}";//��ʾip 
 ?> 
<br> 
�������ԣ� 
<?php
 echo "${_SERVER['HTTP_ACCEPT_LANGUAGE']}";//ʹ�õ����� 
 ?> 
<br> 
������汾�� 
<?php
 echo "${_SERVER['HTTP_USER_AGENT']}";//������汾��Ϣ 
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