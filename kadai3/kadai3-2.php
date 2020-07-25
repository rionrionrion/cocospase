<!DOCTYPE html>
<html>
<head>
<meta charest='utf-8'/>
<title>簡易掲示板</title>
</head>
<body>
<form action ="<?php echo($_SERVER['PHP_SELF']) ?>" method="post">
ユーザー登録<br />
  名前：<br />
  <input type="text" name="name"><br />
  パスワード:<br/>
  <input type="text" name="pass"><br/>
  <input type="submit" name="submit" value="登録"><br />
</form>

<?php
//MySQL接続情報
$dbuser="co-19-203.99sv-c";
$dbpass="b3TDXGmF";
//接続情報
$dsn = 'mysql:host=localhost;dbname=co_19_203_99sv_coco_com;charset=utf8mb4';

$user1="CREATE TABLE user_information(
id INT  auto_increment primary key ,
pass_id  varchar(100),
name varchar(100),
pass varchar(100),
time integer  
)engine=innodb default charset=utf8";

try {
$pdo = new PDO($dsn, $dbuser, $dbpass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
//$res = $pdo->query($user1);

//新規追加 (idがない場合)
if(isset($_POST["submit"]) && !isset($_POST["id"])) {
    if (((isset($_POST["name"])) && ($_POST["name"] != "")) && ((isset($_POST["pass"])) && ($_POST["pass"] != ""))){
    if (isset($_POST["name"])){
      $name=$_POST["name"];
      $name = htmlspecialchars ($name);}
   if(isset($_POST["pass"])){
      $pass=$_POST['pass'];
      $pass = htmlspecialchars ($pass);}
$create_id = uniqid();
$user2="INSERT INTO user_information (pass_id,name,pass,time) VALUES
('$create_id','$name','$pass',cast(now() as date))";
$res=$pdo->query($user2);}}
 

foreach($pdo->query("select * from user_information")as $value){
 echo "名前："."$value[name]"."<br>";
 echo "パスワード："."$value[pass]"."<br>";
 echo "ID："."$value[pass_id]"."<br>";
 echo "登録日時："."$value[time]"."<br>";
 echo "<br>";}


//cookieに保存
if (isset($_COOKIE["loginid"],$_COOKIE["loginpass"])){
    $loginid = $_COOKIE["loginid"];
    $loginpass = $_COOKIE["loginpass"];
}else{
    $loginid= '';
    $loginpass='';
}




}catch (PDOException $user1) {
die('database error' .$user1->getMessage() );}

?>
<form action="" method="post">
ログインフォーム<br />
  ID：<br />
  <input type="text" name="loginid"><br />
  パスワード:<br/>
  <input type="text" name="loginpass"><br/>
  <input type="submit" name="submit"  value="送信"><br />

</form>


<?php
try {
$pdo = new PDO($dsn, $dbuser, $dbpass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);



if (isset($_POST["loginid"])&& isset($_POST["loginpass"])){
if (isset($_POST["loginid"])){
 $loginid = $_POST["loginid"];}
if (isset($_POST["loginpass"])){
 $loginpass = $_POST["loginpass"];}

$submit = $_POST["submit"];
if($submit == "送信"){
    setcookie("loginid" , "$loginid" , time() + 60 * 60 * 24 * 14);
    $message ='ログイン情報を記録しました';
}else{
    setcookie('loginid','');
    $message = '記録しませんでした';
}}
}catch (PDOException $user1) {
die('database error' .$user1->getMessage() );}


foreach($pdo->query("select * from user_information ")as $value){
if ("$value[pass_id]" == $loginid && "$value[pass]" == $loginpass){
if (isset($_COOKIE['name'])){
    $name = $_COOKIE['name'];}

?>
<form action=""  method="post">

  名前：<br />
  <input type="text" name="name" value=<?php echo "$value[name]"; ?>><br />
  コメント：<br />
  <textarea name="comment"  cols="30" rows="5"></textarea><br />
  <input type="submit" name="submit" value="送信"><br />
</form>
<?php
}else{
    $name = '';

}
//MySQL接続情報
$dbuser="co-19-203.99sv-c";
$dbpass="b3TDXGmF";
//接続情報
$dsn = 'mysql:host=localhost;dbname=co_19_203_99sv_coco_com;charset=utf8mb4';

$user3="CREATE TABLE keijiban(
id INT  auto_increment primary key ,
name varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
comment text   CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
picture  LONGBLOB NOT NULL 
) ENGINE = InnoDB";



   
try {
$pdo = new PDO($dsn, $dbuser, $dbpass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

//$res = $pdo->query($user3);

 if (((isset($_POST["name"])) && ($_POST["name"] != ""))&&((isset($_POST["comment"])) && ($_POST["comment"] != ""))){
    if (isset($_POST["comment"])){
      $comment=$_POST['comment'];}
      $comment = htmlspecialchars ($comment);
$user4="INSERT INTO keijiban(name,comment) VALUES ('$value[name]','$comment')";
$res=$pdo->query($user4);}
foreach($pdo->query("select * from keijiban")as $value1){
 echo "名前："."$value1[name]"."<br>";
 echo "コメント："."$value1[comment]"."<br>";
 echo "<br>";}
}catch (PDOException $user2){
die('database error' .$user2->getMessage() );}}

?>
</body>
</html>