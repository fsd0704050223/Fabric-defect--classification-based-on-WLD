<!doctype html> 
<html> 
<head> 
 //<meta charset="gb2312"> 
 <title>��¼ϵͳ�ĺ�ִ̨�й���</title> 
</head> 
<body> 
 <?php
 header('Content-Type: text/html; charset=gb2312');
 session_start();//��¼ϵͳ����һ��session���� 
 $username=$_REQUEST["username"];//��ȡhtml�е��û�����ͨ��post���� 
 $password=$_REQUEST["password"];//��ȡhtml�е����루ͨ��post���� 
  
 $con=mysqli_connect("localhost","root","123456");//����mysql ���ݿ⣬�˻���root ������root 
 if (!$con) { 
 die('���ݿ�����ʧ��'.$mysqli_error($con)); 
 } 
 mysqli_select_db($con,"test");//use user_info���ݿ⣻ 
 $dbusername=null; 
 $dbpassword=null; 
 $result=mysqli_query($con,"select * from user_info where username ='$username';");//�����Ӧ�û�������Ϣ 
 while ($row=mysqli_fetch_array($result)) {//whileѭ����$result�еĽ���ҳ��� 
 $dbusername=$row["username"]; 
 $dbpassword=$row["password"]; 
 } 
 if (is_null($dbusername)) {//�û��������ݿ��в�����ʱ����index.html���� 
 ?> 
 <script type="text/javascript"> 
 alert("�û���������"); 
 window.location.href="index.html"; 
 </script> 
 <?php
 } 
 else { 
 if ($dbpassword!=$password){//����Ӧ���벻��ʱ����index.html���� 
 ?> 
 <script type="text/javascript"> 
 alert("�������"); 
 window.location.href="index.html"; 
 </script> 
 <?php
 } 
 else { 
 $_SESSION["username"]=$username; 
 $_SESSION["code"]=mt_rand(0, 100000);//��session��һ�����ֵ����ֹ�û�ֱ��ͨ�����ý������welcome.php 
 ?> 
 <script type="text/javascript"> 
 window.location.href="welcome.php"; 
 </script> 
 <?php
 } 
 } 
 mysqli_close($con);//�ر����ݿ����ӣ��粻�رգ��´�����ʱ����� 
 ?> 
</body> 
</html> 