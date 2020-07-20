<!DOCTYPE html>
<html>
<head>
<meta charest='utf-8'/>
<title>フォームからの入力</title>
</head>
<body>
<form action="kadai_5_1.php" method="post">
 名前:<br/>
 <input type="text" name="name" size="30" value=""/><br/>
 メールアドレス:<br/>
 <input type="text" name="mail" size="30" value=""/><br/>
 コメント:<br/>
 <textarea name="comment" cols="30" rows="5"></textarea><br/>
 <br/>
 <input type="submit" value="登録する"/>
</form>
</body>
</html>