<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8" />
<title>お問い合わせフォーム</title>
</head>
<body>
<table border="1">
  <tr>
    <td>名前</td><td><?php echo htmlspecialchars($_POST["name"], ENT_QUOTES) ?></td>
  </tr>
  <tr>
    <td>メールアドレス</td><td><?php echo htmlspecialchars($_POST["mail"], ENT_QUOTES) ?></td>
  </tr>
  <tr>
    <td>コメント</td><td><?php echo nl2br(htmlspecialchars($_POST["comment"], ENT_QUOTES)) ?></td>
  </tr>
</table>

</form>
</body>
</html>