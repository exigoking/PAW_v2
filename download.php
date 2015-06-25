<!doctype html>
<html lang="en">
<head>
<title>Download File From MySQL Database</title>
<link rel="stylesheet" href="css/download.css" type="text/css"/>
</head>
<body>
<?php
//database connection
$con = mysql_connect('localhost', 'root', 'Anv1kgrv') or die(mysql_error());
//select database
$db = mysql_select_db('my_db', $con);
$query = "SELECT id, name FROM upload";
$result = mysql_query($query) or die('Error, query failed');
if(mysql_num_rows($result) == 0)
{
echo "Database is empty <br>";
}
else
{
while(list($id, $name) = mysql_fetch_array($result))
{
?>
<a href="download.php?id=<?php echo urlencode($id);?>"
><?php echo "<div id = \"downloads\">" .urlencode($name). "</div>";?></a> <br>
<?php
}
}
mysql_close();
?>
</body>
</html>
<?php
if(isset($_GET['id']))
{
// if id is set then get the file with the id from database
$con = mysql_connect('localhost', 'root', 'Anv1kgrv') or die(mysql_error());
$db = mysql_select_db('my_db', $con);
$id    = $_GET['id'];
$query = "SELECT name, type, size, content " .
         "FROM upload WHERE id = '$id'";
$result = mysql_query($query) or die('Error, query failed');
list($name, $type, $size, $content) = mysql_fetch_array($result);
header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
ob_clean();
flush();
echo $content;
mysql_close();
exit;
}
?>