<!doctype html> 
<html> 
<head> 
//<meta charset="gb2312"> 
 <title>注册用户</title> 
</head> 
<body> 
 <?php
 header('Content-Type: text/html; charset=gb2312');
 session_start(); 
 $username=$_REQUEST["username"]; 
 $password=$_REQUEST["password"]; 
  
 $con=mysqli_connect("localhost","root","123456"); 
 if (!$con) { 
 die("数据库连接失败".$mysqli_error($con)); 
 } 
 mysqli_select_db($con,"test"); 
 $dbusername=null; 
 $dbpassword=null; 
 $result=mysqli_query($con,"select * from user_info where username ='$username';"); 
 if (!$result) {
 die("Error:".mysqli_error($con));}
 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) { 
 $dbusername=$row["username"]; 
 $dbpassword=$row["password"]; 
 } 
 if(!is_null($dbusername)){ 
 ?> 
 <script type="text/javascript"> 
 alert("用户已存在"); 
 window.location.href="register.html"; 
 </script> 
 <?php
 } 
 mysqli_query($con,"insert into user_info (username,password) values('$username','$password')") or die("存入数据库失败".mysqli_error($con)) ; 
 mysqli_close($con); 
 ?> 
 <script type="text/javascript"> 
 alert("注册成功"); 
 window.location.href="index.html"; 
 </script> 
  
  
</body> 
</html> 