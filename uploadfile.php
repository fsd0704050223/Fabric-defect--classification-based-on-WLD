
<?php
/**
* desc��FTP��
* link��www.phpfensi.com
* date��2013/02/24
*/
class ftp
{
public $off;  // ���ز���״̬(�ɹ�/ʧ��)
public $conn_id;  // FTP����

/**
* ������FTP����
* @FTP_HOST -- FTP����
* @FTP_PORT -- �˿�
* @FTP_USER -- �û���
* @FTP_PASS -- ����
*/
function __construct($FTP_HOST,$FTP_PORT,$FTP_USER,$FTP_PASS)
{
$this->conn_id = @ftp_connect($FTP_HOST,$FTP_PORT) or die("FTP����������ʧ��");
@ftp_login($this->conn_id,$FTP_USER,$FTP_PASS) or die("FTP��������½ʧ��");
@ftp_pasv($this->conn_id,1); // �򿪱���ģ��
}

/**
* �������ϴ��ļ�
* @path-- ����·��
* @newpath -- �ϴ�·��
* @type-- ��Ŀ��Ŀ¼���������½�
*/
function up_file($path,$newpath,$type=true)
{
if($type) $this->dir_mkdirs($newpath);
$this->off = @ftp_put($this->conn_id,$newpath,$path,FTP_BINARY);
if(!$this->off) echo "�ļ��ϴ�ʧ��,����Ȩ�޼�·���Ƿ���ȷ��";
}

/**
* �������ƶ��ļ�
* @path-- ԭ·��
* @newpath -- ��·��
* @type-- ��Ŀ��Ŀ¼���������½�
*/
function move_file($path,$newpath,$type=true)
{
if($type) $this->dir_mkdirs($newpath);
$this->off = @ftp_rename($this->conn_id,$path,$newpath);
if(!$this->off) echo "�ļ��ƶ�ʧ��,����Ȩ�޼�ԭ·���Ƿ���ȷ��";
}

/**
* �����������ļ�
* ˵��������FTP�޸�������,��������ͨ����Ϊ�����غ����ϴ����µ�·��
* @path-- ԭ·��
* @newpath -- ��·��
* @type-- ��Ŀ��Ŀ¼���������½�
*/
function copy_file($path,$newpath,$type=true)
{
$downpath = "c:/tmp.dat";
$this->off = @ftp_get($this->conn_id,$downpath,$path,FTP_BINARY);// ����
if(!$this->off) echo "�ļ�����ʧ��,����Ȩ�޼�ԭ·���Ƿ���ȷ��";
$this->up_file($downpath,$newpath,$type);
}

/**
* ������ɾ���ļ�
* @path -- ·��
*/
function del_file($path)
{
$this->off = @ftp_delete($this->conn_id,$path);
if(!$this->off) echo "�ļ�ɾ��ʧ��,����Ȩ�޼�·���Ƿ���ȷ��";
}

/**
* ����������Ŀ¼
* @path -- ·��
*/
function dir_mkdirs($path)
{
$path_arr  = explode('/',$path);  // ȡĿ¼����
$file_name = array_pop($path_arr);// �����ļ���
$path_div  = count($path_arr);// ȡ����

foreach($path_arr as $val)// ����Ŀ¼
{
if(@ftp_chdir($this->conn_id,$val) == FALSE)
{
$tmp = @ftp_mkdir($this->conn_id,$val);
if($tmp == FALSE)
{
echo "Ŀ¼����ʧ��,����Ȩ�޼�·���Ƿ���ȷ��";
exit;
}
@ftp_chdir($this->conn_id,$val);
}
}

for($i=1;$i<=$path_div;$i++)  // ���˵���
{
@ftp_cdup($this->conn_id);
}
}

/**
* �������ر�FTP����
*/
function close()
{
@ftp_close($this->conn_id);
}
}
/**
if (is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {
  $ftp_server = "http://192.168.1.8:5506";
  $ftp_user_name = "user1";
  $ftp_user_pass = "123";
  $conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server");
  $file = $_FILES['uploadfile']['tmp_name'];
  $remote_file = '/src'.$_FILES['uploadfile']['name'];
  $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

  if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
    echo "�ļ�:".$_FILES['uploadfile']['name']."�ϴ��ɹ�";
  } else {
    echo "�ϴ�ʧ��";
  }
  ftp_close($conn_id);
}
// class class_ftp end
 */
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>

