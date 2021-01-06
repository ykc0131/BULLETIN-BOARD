<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

$file_id = $_REQUEST['file_id'];

$sql = "SELECT file_id, name_ori,name_save FROM file WHERE file_id=?";
$stmt = mysqli_prepare($conn, $sql);

$bind = mysqli_stmt_bind_param($stmt, "s", $file_id);
$exec = mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$name_ori = $row['name_ori'];
$name_save = $row['name_save'];

$filedir = 'data/';
$fullpath = $filedir.'/'.$name_save;

$size = filesize($fullpath);

header("Content_Disposition : attachment; filename = $name_ori".iconv('utf-8','euc-kr'));
header("Content-Length :$size");
header("Content-Type : application/octet-stream");
header("Content-Transfer-Encoding: binary");

$fh = fopen($filepath,'r');
fpassthru($fh);
mysqli_free_result($result);
mysqli_stmt_close($stmt);
mysqli_close($conn);
exit;



 ?>
