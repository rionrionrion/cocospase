<!DOCTYPE html>
<html>
<head>
<meta charest='utf-8'/>
<title>フォームからの入力</title>
</head>
<body>
<?php
$text = file_get_contents('kadai_5.txt');
$array = explode(PHP_EOL, trim($text));

var_dump($array);
?>
</form>
</body>
</html>
