<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");


$filtered = array(
  'idvalue' => mysqli_real_escape_string($conn,$_POST['idvalue']),
  'title' => mysqli_real_escape_string($conn,$_POST['title']),
  'description'=> mysqli_real_escape_string($conn,$_POST['description'])
);
$file_id = md5(uniqid(rand(),true));

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

if($_FILES['file']['name']!==""){
    $upload_dir = 'C:\\Bitnami\\wampstack-7.3.16-0\\apache2\\htdocs\\image\\';
    $frename = rand(1000,10000)."-".$_FILES["file"]['name'];
    $fname = $_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    if(move_uploaded_file($tname, $upload_dir.$frename)){
      $name_ori = $fname;
      $name_save = $frename;

      $sql = "
      INSERT INTO file(
        file_id, name_ori, name_save)
        VALUES(
          '$file_id',
          '$name_ori',
          '$name_save'
      )";
      $result = mysqli_query($conn,$sql);
    }
}

if($result === false){
  echo "저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요";
  error_log(mysqli_error($conn));
} else{
  echo '성공했습니다.<a href="board.php?id='.$filtered['idvalue'].'">돌아가기</a>' ;
}
 ?>
