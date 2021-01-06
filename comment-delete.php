<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

settype($_POST['i'],'integer');

$flitered = array(
  'i' => mysqli_real_escape_string($conn,$_POST['i']),
  'idvalue' => mysqli_real_escape_string($conn,$_POST['idvalue']),
);

$filtered_id = mysqli_real_escape_string($conn,$_POST['i']);
$sql = "SELECT * FROM descrip WHERE i={$filtered_id}";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

if($flitered['idvalue'] === $row['id'] )
{
  $sql = "
    DELETE FROM comt
      WHERE
       i = {$flitered['i']}
  ";
  $result = mysqli_query($conn,$sql);
  if($result === false){
    echo "저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요";
    error_log(mysqli_error($conn));
  } else{
    echo '삭제했습니다.<a href=""board.php?id='.$flitered['idvalue'].'">돌아가기</a>' ;
  }
}
else{
  echo '작성자가 아니므로 수정할 수 없습니다.<a href="board.php?id='.$flitered['idvalue'].'">돌아가기</a>';
}
 ?>
