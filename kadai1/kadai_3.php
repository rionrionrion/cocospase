
<!DOCKTYPEhtml> 
<html>
<meta charset="UTF-8"> 
<head>
<title>PHPテスト</title>
</head>

<body>
<p>
<?php

$fp = fopen("kadai_2.txt", "r");
while ($line = fgets($fp)) {
  echo "$line<br />";
}
fclose($fp);

?>

</p>
</body>
</html>