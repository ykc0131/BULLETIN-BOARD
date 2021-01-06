<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

settype($_POST['n'],'integer');

$flitered = array(
  'n' => mysqli_real_escape_string($conn,$_POST['n']),
  'idvalue' => mysqli_real_escape_string($conn,$_POST['idvalue']),
);

$filtered_id = mysqli_real_escape_string($conn,$_POST['n']);
$sql = "SELECT * FROM descrip WHERE n={$filtered_id}";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

if($flitered['idvalue'] === $row['id'] )
{
  $sql = "
    DELETE FROM descrip
      WHERE
       n = {$flitered['n']}
  ";
  $result = mysqli_query($conn,$sql);
  if($result === false){
    echo "저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요";
    error_log(mysqli_error($conn));
  } else{
    #수정하기
    echo '삭제했습니다.<a href="board.php?id='.$flitered['idvalue'].'">돌아가기</a>' ;
  }
}
else{
  echo '작성자가 아니므로 수정할 수 없습니다.<a href="board.php?id='.$flitered['idvalue'].'">돌아가기</a>';
}
 ?>
