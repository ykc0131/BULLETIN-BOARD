<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");


$filtered = array(
  'ID' => mysqli_real_escape_string($conn,$_POST['id']),
  'PW' => mysqli_real_escape_string($conn,$_POST['pw'])
);

$filtered_id = mysqli_real_escape_string($conn,$_POST['id']);
$sql = "SELECT * FROM client WHERE id='{$filtered_id}'";
$result =mysqli_query($conn,$sql);
if($result === false){
  echo "문제가 발생했습니다. 관리자에게 문의해주세요";
  error_log(mysqli_error($conn));
}
else{
  $row = mysqli_fetch_array($result);
  if($filtered['ID'] === $row['id'] AND $filtered['PW'] === $row['pw']){
     ?> <script> alert('로그인되었습니다'){return false;}; </script> <?php
     header("Location:index.php?id={$filtered['ID']}");
   }
  else {
    echo '비밀번호가 일치하지 않습니다.<a href="index.php">돌아가기</a> ';
  }
}
?>
