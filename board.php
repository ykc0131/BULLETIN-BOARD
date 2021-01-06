<?php
$conn = mysqli_connect("localhost","root","131719", "SIGNUP");

$article= array(
  'id' => "check",
  'n' => "",
  'title' => "",
  'description'=>"",
  'file_id' => "good"
);

$author = "";
$create ="";
$show = "";
$line ="";
if(isset($_GET['id'])){
  $filtered_id = mysqli_real_escape_string($conn,$_GET['id']);
  $sql = "SELECT id from client where id= '{$filtered_id}'";
  $result = mysqli_fetch_array(mysqli_query($conn, $sql));
  $article['id'] = htmlspecialchars($result['id']);
  if(empty($article['id'])){

    header('Location:index.php');
  }
  $create = '<input type = "submit" value = "create" onclick = "location.href=\'create.php?id='.$_GET['id'].'\'"> ';
  if(isset($_GET['n'])){
    $filtered_id = mysqli_real_escape_string($conn,$_GET['n']);
    $sql = "SELECT * FROM descrip WHERE n={$filtered_id}" ;
    $result =mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $article['n'] = htmlspecialchars($row['n']);
    $article['title'] =  htmlspecialchars($row['title']);
    $article['description'] = htmlspecialchars($row['description']);
    $article['file_id'] = $row['file_id'];
    $author = "<p> by {$row['id']}</p>";
    $show =
    '
    <form action = "comment-create.php" method ="POST">
      <table>
        <tr>
          <td>
            <input type="hidden" name= "idvalue" value = "'.$_GET['id'].'">
            <input type="hidden" name= "n" value = "'.$_GET['n'].'">
            <p><textarea name = "comment" placeholder="comment" ></textarea></p>
          </td>
          <td>
            <input type = "submit">
          </td>
        </tr>
      </table>
    </form>
    ';
    $line = "---------------------------";
  }


}
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>BULLETIN BOARD</title>
</head>
 <body>
   <h1><a href = "index.php?id=<?=$_GET['id']?>">HOME</a></h1>
   <?=$create?>
   <br><br>
   <table border = "1">
     <tr>
       <td>n</td><td>Title</td><td></td><td></td>
       <?php
       $sql = "SELECT * FROM descrip" ;
       $result = mysqli_query($conn,$sql);
      while( $row = mysqli_fetch_array($result)){
        $filtered = array(
          'id' => htmlspecialchars($row['id']),
          'n' => htmlspecialchars($row['n']),
          'title' => htmlspecialchars($row['title']),
        );
      ?>
      <tr>
          <td><?=$filtered['n']?></td>
          <td><a href="board.php?n=<?=$filtered['n']?>&id=<?=$_GET['id']?>"><?=$filtered['title']?></a></td>
          <td><a href="update.php?id=<?=$_GET['id']?>&n=<?=$filtered['n']?>">update</a></td>
          <td>
            <form action = "delete.php" method="post" onsubmit="if(!confirm('삭제하시겠습니까?')){return false;}">
              <input type = "hidden" name = "n" value = "<?=$filtered['n']?>">
              <input type = "hidden" name = "idvalue" value = "<?=$_GET['id']?>">
            <input type = "submit" value ="delete">
           </form>
          </td>
      </tr>
      <?php
     }
     ?>
     </tr>
     </table>
     <?=$line?>
     <h2><?=$article['title']?></h2>
     <p><?=$article['description']?></p>
     <?php
     $query ="SELECT name_ori,name_save from file where file_id='{$article['file_id']}'";
     $exec = mysqli_query($conn,$query);
     $filearray = mysqli_fetch_array($exec);
      ?>
     <a href="download1.php?file_id='<?=$article['file_id']?>'"><?=$filearray['name_ori']?></a>
     <?=$author?>
     <?=$line?>
     <table>
         <?php
         if(isset($_GET['n'])){ ?>
           <tr>
             <td>ID</td><td>Comment</td><td></td>
          <?php
           $filtered_id = mysqli_real_escape_string($conn,$_GET['n']);
           $sql = "SELECT * FROM descrip LEFT JOIN comt ON descrip.n=comt.n WHERE descrip.n = {$filtered_id}";
           $result = mysqli_query($conn,$sql);
          while( $row = mysqli_fetch_array($result)){
            $filtered = array(
              'i' => htmlspecialchars($row['i']),
              'id' => htmlspecialchars($row['id']),
              'comment' => htmlspecialchars($row['comment']),
            );
          ?>
          <tr>
              <td><?=$filtered['id']?> : </td>
              <td><?=$filtered['comment'];?>  </td>
              <td>
                <form action = "comment-delete.php" method="post" onsubmit="if(!confirm('삭제하시겠습니까?')){return false;}">
                  <input type = "hidden" name = "i" value = "<?=$filtered['i']?>">
                  <input type = "hidden" name = "idvalue" value = "<?=$_GET['id']?>">
                <input type = "submit" value ="delete">
               </form>
              </td>
          </tr>
          <?php
         }
       }
         ?>
         </tr>
         </table>
     <?=$show?>
   </body>
   </html>
