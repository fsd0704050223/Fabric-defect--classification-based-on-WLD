<!doctype html> 
<html> 
<head> 
<meta charset="gb2312"> 
</head> 
<body> 
<?php
session_start ();//将session销毁时调用destroy 
session_destroy (); 
?> 
<script type="text/javascript"> 
 window.location.href="index.html"; 
</script> 
</body> 
</html> 