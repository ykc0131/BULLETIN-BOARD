<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

settype($_POST['n'],'integer');


$flitered = array(
  'n' => mysqli_real_escape_string($conn,$_POST['n']),
  'idvalue' => mysqli_real_escape_string($conn,$_POST['idvalue']),
  'comment'=>mysqli_real_escape_string($conn,$_POST['comment'])
);

$sql = "
  INSERT INTO comt
    (n,id,comment)
    VALUES(
       '{$flitered['n']}',
       '{$flitered['idvalue']}',
       '{$flitered['comment']}'
      )
";

$result = mysqli_query($conn,$sql);

if($result === false){
  echo "저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요";
  error_log(mysqli_error($conn));
} else{
  ?> <script> alert("board.php?id='.$flitered['idvalue'].'",'성공하였습니다') </script> <?php
}
 ?>
