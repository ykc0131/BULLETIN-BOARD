<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");


$filtered_id = mysqli_real_escape_string($conn,$_POST['id']);
$sql = "SELECT * FROM client WHERE id= {$filtered_id}";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
if(isset($row['id'])===false)
{
  if($_POST['PW1'] == $_POST['PW2']){
    $filtered = array(
      'ID' => mysqli_real_escape_string($conn,$_POST['id']),
      'PW' => mysqli_real_escape_string($conn,$_POST['PW1'])
    );

    $sql = "
      INSERT INTO client
        (id,pw)
        values(
           '{$filtered['ID']}',
           '{$filtered['PW']}'
          )
    ";

    echo $sql;
    $result = mysqli_query($conn,$sql);
    if($result === false){
      echo '아이디가 중복됩니다.<a href="index.php">돌아가기</a>';
    } else{
      echo '성공했습니다.<a href="index.php">돌아가기</a>' ;
    }
  }
  else {
    echo "비밀번호가 일치하지 않습니다.<a href='index.php'>돌아가기</a>";
  }
}
else{
  echo '아이디가22 중복됩니다.<a href="index.php">돌아가기</a>';
}

?>
