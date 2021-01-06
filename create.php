<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

$sql = "SELECT * FROM descrip";
$result =mysqli_query($conn,$sql);

$article= array(
  'id' => "Guest",
);
if(isset($_GET['id'])){
  $article['id']=$_GET['id'];
}

 ?>
<!doctype html>
<html>
<head>
  <title>HOME</title>
  <meta charset ='utf-8'>
</head>
<body>
  <h2>CREATE</h2>
  <form action ="create-process1.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name= "idvalue" value = "<?=$_GET['id'];?>">
    <p><input type = "text" name = "title" placeholder ="title" ></p>
    <p><textarea name="description" placeholder="description" ></textarea></p>
    <input type = "file" name = "file">
    <p><input type ="submit"></p>
  </form>
</body>
</html>
