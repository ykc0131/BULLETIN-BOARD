<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

$article= array(
  'id' => "Guest",
  'n' => "",
  'title' => "",
  'description' => ""
);

if(isset($_GET['n'])){
  $filtered_id = mysqli_real_escape_string($conn,$_GET['n']);
  settype($filtered_id,'integer');
  $sql = "SELECT * FROM descrip WHERE n={$filtered_id}" ;
  $result =mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);
  $article['title'] =  htmlspecialchars($row['title']);
  $article['description'] = htmlspecialchars($row['description']);
}

?>
<!doctype html>
<html>
<head>
  <title>BULLETIN BOARD</title>
  <meta charset="utf-8">
  <title>WEB</title>
</head>
 <body>
   <h2>update</h2>
   <form action ="update-process.php" method="POST">
     <input type ="hidden" name="idvalue" value = "<?=$_GET['id']?>">
     <input type ="hidden" name="n" value = "<?=$_GET['n']?>">
     <p><input type = "text" name = "title" placeholder ="title" value ='<?=$article['title']?>'></p>
     <textarea name="description" placeholder="description" value = '<?=$article['description']?>'></textarea>
     <p><input type ="submit"></p>
   </form>
 </body>
</html>
