登録しました。

<?php
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $name=$_POST["name"];
    $mail=$_POST['mail'];
    $comment=$_POST['comment'];

    $filename="kadai_5.txt";
    $fp = fopen($filename, "a");
   
    fwrite($fp,$name);
    fwrite($fp,$mail);
    fwrite($fp,$comment."\r\n");
    fclose($fp);}
?>

