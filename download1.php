<?php
$file_id = $_REQUEST['file_id'];
echo "hello";
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

$query = "SELECT name_ori, name_save FROM file WHERE file_id = $file_id ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

$name_ori = $row['name_ori'];
$name_save = $row['name_save'];
$fileDir = "C:\\Bitnami\\wampstack-7.3.16-0\\apache2\\htdocs\\data\\";
$fullPath = $fileDir.$name_save;

header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename='.iconv('utf-8','euc-kr',$name_ori));
header('Content-Transfer-Encoding: binary');
header('Content-length: ' . filesize($fullPath));
header('Expires: 0');
header("Pragma: public");

$fh = fopen($fullPath, "rb");
fpassthru($fh);
fclose($fh);

exit;
?>


$conn = mysqli_connect("54.175.116.35","work","1234", "tutu");
