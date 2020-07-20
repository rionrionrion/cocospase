<html>
<head>
<meta charset=utf-8" />
<title>お問い合わせフォーム</title>
</head>
<body>


<?php
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $name=$_POST["name"];
    $mail=$_POST['mail'];
    $comment=$_POST['comment'];

    $filename="kadai_5.txt";
    $fp=fopen($filename,'w');
    
    fwrite($fp,$name);
    fwrite($fp,$mail);
    fwrite($fp,$comment);


    fclose($fp);}
?>
</body>
</html>