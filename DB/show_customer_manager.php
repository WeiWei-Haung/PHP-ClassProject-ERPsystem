<?php
session_start();
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 require 'mysql.php';    $db=Database::initDB();
         echo "<form action='index1.php' method=POST align='right'>";
    echo "<nav class='navbar navbar-default' role='navigation'><ul class='nav nav-pills'> <li role='presentation' class='active'><font color='black'>";
    echo  $_SESSION['name'] . " </font></li> <li role='presentation'><font color='black'>您好  身分:" .       $_SESSION['ident'] . "</font></li>  " . "    <li role='presentation'><button  name='func' type='submit' value='logout_action' class='btn btn-danger'><span class='glyphicon glyphicon-share' aria-hidden='true'>登出</span></button><br><br></li><li role='presentation'><button  name='func' type='submit' value='show_homepage' class='btn btn-danger'><span class='glyphicon glyphicon-home' aria-hidden='true'>首頁</span></button><br><br></li></ul></nav>";
    echo "</form><br><br>";
     echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>";
   
    echo "<h1>客戶清單<h1>";
    $sql="SELECT * From 客戶 order by 客戶id";
    $result=$db->query($sql);
    echo "<form action=index1.php method=POST name='c'>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td>客戶id</td><td>車牌號碼</td><td>姓名</td><td>地址</td><td>生日</td><td>性別</td><td>電話</td></tr>";        

$per= 5; //每頁顯示項目數量
                                   
              if (!isset($_POST["page"])){ //假如$_GET["page"]未設置
                     $page=1; //則在此設定起始頁數
              } else {
                     $page= intval($_POST["page"]); //確認頁數只能夠是數值資料
                     }
              if (!isset($_POST["num"])){ //假如$_GET["page"]未設置
                     $pagenum=count($result->fetchAll());
              } else {
                     $pagenum= intval($_POST["num"]); //確認頁數只能夠是數值資料
                     }
              if (!isset($_POST["pages"])){ //假如$_GET["page"]未設置
                      $pages= ceil($pagenum/$per);
              } else {
                      $pages= intval($_POST["pages"]); //確認頁數只能夠是數值資料
              }
    
             $start = ($page-1)*$per;//記錄偏移量
            
               $sql="SELECT * From 客戶 order by 客戶id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)
    {
       
       echo "<tr><td><input type=radio name=customer_id value=$row[客戶id] ></td><td>$row[客戶id]</td><td>$row[車牌號碼]</td><td>$row[姓名]</td><td>$row[地址]</td><td>$row[生日]</td><td>$row[性別]</td><td>$row[電話]</td></tr>";        
    }
    echo "</table>";
    echo "<button type='submit' name='func' value='insert_customer' class='btn btn-success' onClick='check()'>新增客戶</button>";
    echo "<button type='submit' name='func' value='update_customer' class='btn btn-warning'  onClick='check()'>修改</button>";
    echo "<button type='submit' name='func' value='delete_action_customer' class='btn btn-danger'  onClick='check()'>刪除</button>";
    echo "</form>";
    
      //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_customer_manager.php' method='POST'>
           <button type='submit'  page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_customer_manager.php' method='POST'>";
            echo  " <td><button type='submit'  class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
          
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
   
?>
