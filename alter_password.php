<!doctype html> 
<html> 
<head> 
<meta charset="gb2312"> 
<title>�����޸�����</title> 
</head> 
<body> 
 <?php
header('Content-Type: text/html; charset=gb2312');
 session_start (); 
 $username = $_REQUEST ["username"]; 
 $oldpassword = $_REQUEST ["oldpassword"]; 
 $newpassword = $_REQUEST ["newpassword"]; 
  
 $con = mysqli_connect ( "localhost", "root", "123456" ); 
 if (! $con) { 
 die ( '���ݿ�����ʧ��' . $mysql_error ($con) ); 
 } 
 mysqli_select_db ( $con,"test"); 
 $dbusername = null; 
 $dbpassword = null; 
 $result = mysqli_query ($con,"select * from user_info where username ='$username';" ); 
 while ( $row = mysqli_fetch_array ( $result ) ) { 
 $dbusername = $row ["username"]; 
 $dbpassword = $row ["password"]; 
 } 
 if (is_null ( $dbusername )) { 
 ?> 
 <script type="text/javascript"> 
 alert("�û���������"); 
 window.location.href="alter_password.html"; 
 </script> 
 <?php
 } 
 if ($oldpassword != $dbpassword) { 
 ?> 
 <script type="text/javascript"> 
 alert("�������"); 
 window.location.href="alter_password.html"; 
 </script> 
 <?php
 } 
 mysqli_query ( $con, "update user_info set password='$newpassword' where username='$username'" ) or die ( "�������ݿ�ʧ��" . mysqli_error ($con) );//��������û��������ж�������update�����ݿ��� 
 mysqli_close ( $con ); 
 ?> 
  
  
 <script type="text/javascript"> 
 alert("�����޸ĳɹ�"); 
 window.location.href="index.html"; 
 </script> 
</body> 
</html> 