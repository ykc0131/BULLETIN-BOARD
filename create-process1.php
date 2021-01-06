
#$conn = mysqli_connect("54.175.116.35","work","1234", "tutu");
<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

$file_id ="";
if(isset($_FILES['file']) && $_FILES['file']['name'] != "") {
    $file = $_FILES['file'];
    $upload_directory = 'C:\\Bitnami\\wampstack-7.3.16-0\\apache2\\htdocs\\data\\';
    $ext_str = "hwp,xls,doc,xlsx,docx,pdf,txt,ppt,pptx";
    $allowed_extensions = explode(',', $ext_str);

    $ext = substr($file['name'], strrpos($file['name'], '.') + 1);

    if(!in_array($ext, $allowed_extensions)) {
        echo "<script> alert(\"업로드할 수 없는 확장자 입니다.\")</script>"
    }

    $path = md5(microtime()) . '.' . $ext;
    if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {
        $query = "INSERT INTO file (file_id, name_ori, name_save) VALUES(?,?,?)";
        $file_id = md5(uniqid(rand(), true));
        $name_ori = $file['name'];
        $name_save = $path;

        $stmt = mysqli_prepare($conn, $query);
        $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_ori, $name_save);
        $exec = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
      }
}

$filtered = array(
  'idvalue' => mysqli_real_escape_string($conn,$_POST['idvalue']),
  'title' => mysqli_real_escape_string($conn,$_POST['title']),
  'description'=> mysqli_real_escape_string($conn,$_POST['description'])
);

$sql = "
  INSERT INTO descrip
    (title,description,id,created,file_id)
    VALUES(
       '{$filtered['title']}',
       '{$filtered['description']}',
       '{$filtered['idvalue']}',
       NOW(),
       '$file_id'
      )
";

$result = mysqli_query($conn,$sql);

if($result === false){
  echo "저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요";
  error_log(mysqli_error($conn));
} else{
  echo '성공했습니다.<a href="board.php?id='.$filtered['idvalue'].'">돌아가기</a>' ;
}
 ?>
