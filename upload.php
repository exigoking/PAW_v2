<?php
$ds          = DIRECTORY_SEPARATOR;  //1

$storeFolder = 'uploads';   //2
$where_to = 'C:\Users\Bekzat\Documents\NetBeansProjects\MsgCollector';

if (!empty($_FILES)) {

    //$tempFile = $_FILES['file']['tmp_name'];          //3
    //echo "(string)dirname( __FILE__ )";
    //$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    //$targetPath = $where_to . $ds. $storeFolder . $ds;
    //$targetFile =  $targetPath. $_FILES['file']['name'];  //5

   // move_uploaded_file($tempFile,$targetFile); //6
   database_insert();
}

function database_insert()
{
    echo "starting insert </br>";
//if(isset($_POST['upload'])&&$_FILES['userfile']['size']>=0)
//{
$fileName = $_FILES['file']['name'];
$tmpName  = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileType = $_FILES['userfile']['type'];
$fileType=(get_magic_quotes_gpc()==0 ? mysql_real_escape_string(
$_FILES['userfile']['type']) : mysql_real_escape_string(
stripslashes ($_FILES['userfile'])));
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

$con = mysqli_connect("localhost","root","Anv1kgrv","my_db") or die(mysql_error());
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

echo "connection successful </br>";

mysqli_query($con,"INSERT INTO upload (name, size, type, content )
        VALUES ('$fileName', '$fileSize', '$fileType', '$content')") or die('Error, query failed');

mysqli_close($con);
echo "<br>File $fileName uploaded<br>";

//}

//else {
  //  echo "Did not go to database </br>";
//}


}
?>