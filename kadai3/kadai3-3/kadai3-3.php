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
  <input type="text" name="loginid" value="<?= isset($_POST['loginid']) ? $_POST['loginid'] : null ?>"><br />
  パスワード:<br/>
  <input type="text" name="loginpass"><br/>
  <input type="submit" name="submit"  value="送信"><br />
</form>
<?php

if (isset($_POST["loginid"])&& isset($_POST["loginpass"])){
if (isset($_POST["loginid"])){
 $loginid = $_POST["loginid"];}
if (isset($_POST["loginpass"])){
 $loginpass = $_POST["loginpass"];}

$submit = $_POST["submit"];
if($submit == "送信"){
    setcookie("loginid" , "$loginid" , time() + 60 * 60 * 24 * 14);
    $message ='ログイン情報を記録しました';
foreach($pdo->query("select * from user_information")as $value){
$pass_id="$value[pass_id]";
$pass="$value[pass]";}
if ($pass_id == $loginid && $pass == $loginpass){
if (isset($_COOKIE['name'])){
    $name = $_COOKIE['name'];}
}else{
    setcookie('loginid','');
    $message = '記録しませんでした';

}
}else{
    $name = '';}

?>
<form action=""  method="post">
  名前：<br />
  <input type="text" name="name" value=<?php echo "$value[name]"; ?>><br />
  コメント：<br />
  <textarea name="comment"  cols="30" rows="5"></textarea><br />
  <input type="submit" name="submit" value="送信"><br />
</form>
 <form action="kadai3-3.php" enctype="multipart/form-data" method="post">
        <label>画像/動画アップロード</label>
        <input type="file" name="upfile">
        <br>
        ※画像はjpeg方式，png方式，gif方式に対応しています．動画はmp4方式のみ対応しています．<br>
        <input type="submit" value="アップロード">
    </form>

<?php

try {
$pdo = new PDO($dsn, $dbuser, $dbpass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);




$user3="CREATE TABLE keijiban(
id INT  auto_increment primary key ,
name varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
comment text   CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
picture  LONGBLOB NOT NULL 
) ENGINE = InnoDB";

$user4="CREATE TABLE mediatest(
id INT  auto_increment primary key ,
fname varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
extension text   CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
raw_data LONGBLOB NOT NULL 
) ENGINE = InnoDB";
//$sql4 = "DROP TABLE mediatest";
//$res = $pdo->query($user4);

 if (((isset($_POST["name"])) && ($_POST["name"] != ""))&&((isset($_POST["comment"])) && ($_POST["comment"] != ""))){
    if (isset($_POST["comment"])){
     $comment=$_POST['comment'];
      $comment = htmlspecialchars ($comment);}
$user4="INSERT INTO keijiban(name,comment) VALUES('$value[name]','$comment')";
$res=$pdo->query($user4);}
foreach($pdo->query("select * from keijiban")as $value1){
 echo "名前："."$value1[name]"."<br>";
 echo "コメント："."$value1[comment]"."<br>";
 echo "<br>";
}
  //ファイルアップロードがあったとき
        if (isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error']) && $_FILES["upfile"]["name"] !== ""){
            //エラーチェック
            switch ($_FILES['upfile']['error']) {
                case UPLOAD_ERR_OK: // OK
                    break;
                case UPLOAD_ERR_NO_FILE:   // 未選択
                    throw new RuntimeException('ファイルが選択されていません', 400);
                case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                    throw new RuntimeException('ファイルサイズが大きすぎます', 400);
                default:
                    throw new RuntimeException('その他のエラーが発生しました', 500);}
            

            //画像・動画をバイナリデータにする．
            $raw_data = file_get_contents($_FILES['upfile']['tmp_name']);

            //拡張子を見る
            $tmp = pathinfo($_FILES["upfile"]["name"]);
            $extension = $tmp["extension"];
            if($extension === "jpg" || $extension === "jpeg" || $extension === "JPG" || $extension === "JPEG"){
                $extension = "jpeg";
            }
            elseif($extension === "png" || $extension === "PNG"){
                $extension = "png";
            }
            elseif($extension === "gif" || $extension === "GIF"){
                $extension = "gif";
            }
            elseif($extension === "mp4" || $extension === "MP4"){
                $extension = "mp4";
            }
            else{
                echo "非対応ファイルです．<br/>";
                echo ("<a href=\"kadai3-3.php\">戻る</a><br/>");
                exit(1);}
            

            //DBに格納するファイルネーム設定
            //サーバー側の一時的なファイルネームと取得時刻を結合した文字列にsha256をかける．
            $date = getdate();
            $fname = $_FILES["upfile"]["tmp_name"].$date["year"].$date["mon"].$date["mday"].$date["hours"].$date["minutes"].$date["seconds"];
            $fname = hash("sha256", $fname);
            $savename=dirname(__FILE__)."/img/".$fname.".".$extension;
            //画像・動画をDBに格納．
            $sql = "INSERT INTO mediatest(fname, extension, raw_data) VALUES(:fname, :extension, :raw_data);";
            $stmt = $pdo->prepare($sql);
            $stmt -> bindValue(":fname",$fname, PDO::PARAM_STR);
            $stmt -> bindValue(":extension",$extension, PDO::PARAM_STR);
            $stmt -> bindValue(":raw_data",'$raw_data', PDO::PARAM_STR);
            $stmt -> execute();
    }}catch(PDOException $e){
        echo("<p>500 Inertnal Server Error</p>");
        exit($e->getMessage());
    }
    //DBから取得して表示する．


    $sql = "SELECT * FROM mediatest ORDER BY id;";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
        echo ($row["id"]."<br/>");
        //動画と画像で場合分け
        $target = $row["fname"];

        if($row["extension"] == "mp4"){
            echo ("<video src=\"kadai3-3-1.php?target=$target\" width=\"500\" height=\"500\" controls></video>");
        }
        elseif($row["extension"] == "jpeg" || $row["extension"] == "png" || $row["extension"] == "gif"){
            $row["raw_data"] = base64_encode($row["raw_data"]);
echo ("<img src='data:image/{$row["extension"]};base64,{$row["raw_data"]}'/>");
        }
        echo ("<br/><br/>");}}

   
    ?>