<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");
$sql = "SELECT * FROM client";
$result =mysqli_query($conn,$sql);

$article= array(
  'id' => "Guest",
  'n' => "",
  'title' => "",
  'description'=>"THIS IS BULLETIN BOARD!"
);
$list = '';
$show ="";
$author = "";
$create = "";
$update = "";
$delete = "";
$board ="";

if(isset($_GET['id'])){
  $filtered_id = mysqli_real_escape_string($conn,$_GET['id']);
  $sql =  "SELECT * FROM client WHERE id={$filtered_id}";
  $result =mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);
  $article['id'] =  htmlspecialchars($row['id']);
  $create = '<a href = "create.php?id='.$_GET['id'].'">create</a>';
  $board = '<a href = "board.php?id='.$_GET['id'].'">Bulletin Board</a>';
  $show=
  '<form action = "logout.php" method="post" onsubmit="if(!confirm(\'로그아웃하시겠습니까?\')){return false;}">
    <input type = "submit" value ="logout">
  </form>';

  $sql = "SELECT * FROM descrip";
  $result =mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($result)){
    //﻿<li><a href = " index.php"?id=0"?index</a></li>
    $escaped_title = htmlspecialchars($row['title']);
    $list=$list."<li><a href=\"index_TEST.php?n={$row['n']}&id={$_GET['id']}\">{$row['title']}</a></li>";
  }

  if(isset($_GET['n'])){
    $filtered_id = mysqli_real_escape_string($conn,$_GET['n']);
    $sql = "SELECT * FROM descrip WHERE n={$filtered_id}" ;
    $result =mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $article['n'] = htmlspecialchars($row['n']);
    $article['title'] =  htmlspecialchars($row['title']);
    $article['description'] = htmlspecialchars($row['description']);
    $author = "<p> by {$row['id']}</p>";
    $update = '<a href = "update.php?n='.$_GET['n'].'&id='.$_GET['id'].'">update</a>';
    $delete = '
    <form action ="delete.php" method = "POST"  onsubmit="if(!confirm(\'sure?\')){return false;}">
    <input type ="hidden" name = "n" value ="'.$_GET['n'].'">
    <input type ="hidden" name = "idvalue" value ="'.$_GET['id'].'">
    <input type = "submit" value ="delete">
    </form>
    ';
  }
}
else {
  $show =
  '
      <form action="login.php" method ="POST">
        <table>
        <tr>
          <td>
            <p><input type="text" name="id" placeholder="ID"></p>
            <p><input type="password" name="pw" placeholder="PW"></p>
          </td>
          <td>
            <br><br>
            <input type ="submit" value ="login">
          </td>
        </tr>
        </table>
      </form>
      <br>
      <input type = \'submit\' value = \'sign up\' onclick = "location.href=\'sign_up.php\'"> -> join us:)

  ';


}
 ?>
<!doctype html>
<html>
<head>
  <title>BULLETIN BOARD</title>
  <meta charset ='utf-8'>
</head>
<body>
  <h1>Welcome, <?=$article['id']?> </h1>
  <?=$board?>
  <ol><?=$list?></ol>
  <?=$create?>
  <h2><?=$article['title']?></h2>
  <?=$article['description']?>
  <?=$author?>
  <?=$update?>
  <?=$delete?>
  <br><br>
  <p><?=$show?></p>
</body>
</html>
