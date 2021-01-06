<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

$sql = "SELECT * FROM topic";
$result =mysqli_query($conn,$sql);

$article= array(
  'id' => "Guest",
);
?>

<!doctype html>
<html>
<head>
  <title>SIGNUP</title>
  <meta charset ='utf-8'>
</head>
<body>
    <form action="signup-process.php" method ="POST">
      <p><input type="text" name="id" placeholder="ID"></p>
      <p><input type="password" name="PW1" placeholder="PW"></p>
      <p><input type="password" name="PW2" placeholder="comfirm PW"></p>
      <p><input type ="submit"></p>
    </form>
</body>
</html>
