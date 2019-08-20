<?php
 echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
  echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>";
$key = "146c07ef2479cedcd54c7c2af5cf3a80";
$salty = "i3flm234rmsldk543kf2jvl2sdfj";
$username = addslashes($_POST['userid']);
$userpwd = addslashes($_POST['userpwd']);
$userpwd =hash_hmac("sha1", $salty + $userpwd, $key);//加密
require 'mysql.php';
$db = Database::initDB();

$sql = "SELECT * FROM user ";
$result = $db->query($sql);
$check = false;
foreach ($result->fetchAll()as $row) {


    if ($username != null && $userpwd != null && $row['name'] == $username && $row['password'] == $userpwd) {           //判斷帳號密碼是否與資料庫中相同

        $_SESSION['name'] = $username;          //登入成功的話,在session中加入該使用者名稱
        $_SESSION['type'] = $row['type'];
        echo "<div class='alert alert-success' role='alert'>登入成功，正在進入系統...</div>";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
        $check = true;
        break;
    }
} if ($check == false) {
    echo "<div class='alert alert-danger' role='alert'>登入失敗!";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=show_homepage.php>';
}

?>

