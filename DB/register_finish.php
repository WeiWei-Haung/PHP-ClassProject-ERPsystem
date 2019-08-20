<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//require 'mysql.php';
echo "  

            <html lang= 'zh-Hant'>
            
                <head>
                
               
                    <title>KYMCO </title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>
                    <style> 
                     
                    
                    
                     
                    
%sent-hover{
  cursor: pointer;
  @include trans-time(1s);
}
* {
    outline: none;
}   
html,
body {
    height: 100%;
    margin: 0;
}
    
body {
    background:black;
    color: white;
    font-family: monospace;
}
    
.form-container {
    margin: 30px 0;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
    
.input-container {
    position: relative;
    margin-top: 2em;
    width: 250px;
}
input,
textarea {
    position: relative;
    width: 100%;
    padding: 6px 0;
    line-height: 160%;
    font-size: 14px;
    background: none;
    color: white;
    border: none;
    border-bottom: 1px solid #aaa;
    }

label {
    position: absolute;
    left: 0;
    top: 0;
    font-size: 14px;
    line-height: 14px;
    padding: 6px 0;
    text-transform: uppercase;
    @include trans-time(0.5s);
}

input:focus+label,
input:valid+label,
textarea:focus+label,
textarea:valid+label {
    transform: translateX(-4.5em);
    opacity: 0.5;
}

input[value]:invalid+label,
textarea[value]:invalid+label{
  color:red;
  transform: translateX(-4.5em);
  opacity:0.5;
}

.sent-wrap{
    @extend %sent-hover;
    #sent{
        @extend %sent-hover;
        z-index: 2;
    }
    &:after{
        content: 'CLICK!';
        line-height: 34px;
        position: absolute;
        text-align: center;
        color: black;
        opacity: 0;
        top: 0;
        left: 0;
        height: 100%;
        background: white;
        @include trans-time(0.5s);
        width: 100%;
    
    }
    &:hover{
        #sent{
           opacity: 0;
        }
        &:after{
           opacity: 1;
        }
      }
}
</style>
<script>
$('input, textarea').on('input',function(){
  this.setAttribute('value', this.value);
});
</script>

                </head>";
 echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>";
$key = "146c07ef2479cedcd54c7c2af5cf3a80";
$salty = "i3flm234rmsldk543kf2jvl2sdfj";

 require 'mysql.php';
$db = Database::initDB();

$name = $_POST['name'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$type=$_POST['type'];
$pw = hash_hmac("sha1", $salty + $pw, $key);
$pw2 = hash_hmac("sha1", $salty + $pw2, $key);
$check = 1;
if ($name != null && $pw != null && $pw2 != null && $pw == $pw2) {         //判斷2組密碼是否輸入相同
 
    
    $sql = "SELECT * FROM user";
    $result = $db->query($sql);

    foreach ($result->fetchAll() as $row) {              //判斷帳號是否重複
        if ($name == $row['name']) {
            $check = 2;
        } 
    }

    if ($check == 1) {                  //如果帳號沒有重複的話..
        
        $sql = "INSERT INTO user(userID,name,password,type) VALUES (NULL,'$name','$pw','$type')";
        $result = $db->exec($sql);
        if ($result > 0) {
            $_SESSION['name'] = $name;
            $_SESSION['type'] = $type;
            echo "新增成功";
            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
        } else {
            echo "新增失敗";
            echo '<meta http-equiv=REFRESH CONTENT=1;url=register.html>';
        }
    } else if ($check == 2) {                         //如果帳號重複的話
        echo "帳號已存在，請換一組帳號!";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=register.html>';
    } 
} else {                     //2次密碼輸入不相同的話
    echo '密碼或其他輸入有誤!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=register.html>';
}
echo "</html>"
?>