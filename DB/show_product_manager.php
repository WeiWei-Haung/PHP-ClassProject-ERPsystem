<?php
error_reporting(0);
session_start();
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>
                    
                     ";
                 
    
    echo "<form action=show_product_manager.php method=POST >";
    echo "<select name='product' style='color:black;'><font color='black'><option value='car' style='color:black;'>車種清單</option><option value='compon' style='color:black;'>零組件清單</font></option><option value='care' style='color:black;'>保養品清單</option></font></switch>";
    echo "<input type='submit' value='送出'/>";
    echo "</form>";
    $product = $_POST['product'];
      echo "<form action='index1.php' method=POST align='right'>";
    echo "<nav class='navbar navbar-default' role='navigation'><ul class='nav nav-pills'> <li role='presentation' class='active'><font color='black'>";
    echo  $_SESSION['name'] . " </font></li> <li role='presentation'><font color='black'>您好  身分:" .       $_SESSION['ident'] . "</font></li>  " . "    <li role='presentation'><button  name='func' type='submit' value='logout_action' class='btn btn-danger'><span class='glyphicon glyphicon-share' aria-hidden='true'>登出</span></button><br><br></li><li role='presentation'><button  name='func' type='submit' value='show_homepage' class='btn btn-danger'><span class='glyphicon glyphicon-home' aria-hidden='true'>首頁</span></button><br><br></li></ul></nav>";
    echo "</form><br><br>";
    
    
    if($product=='car'){
          require 'mysql.php';
    $db=Database::initDB();
    
    
    echo "<h1>車種清單<h1>";
    $sql="select * From 車種 order by 車種id";
    $result=$db->query($sql);
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td><font color='black'>車種id</font></td><td><font color='black'>型號</font></td><td>排氣量</td><td><font color='black'>庫存</font></td><td><font color='black'>單價</font></td><td><font color='black'>成本價</font></td><td>圖片</td></tr>";        

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
            
               $sql="select * From 車種 order by 車種id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)
    {
       echo "<tr style='color:black;'><td><input type=radio name=product_id value=$row[車種id]></td>
       <td>$row[車種id]</td>
       <td>$row[型號]</td>
       <td>$row[排氣量]</td>
       <td>$row[庫存]</td>
       <td>$row[單價]</td>
       <td>$row[成本價]</td>
       <td><img src=$row[車種圖片]></td>
       </tr>";        
    }
    echo "</table>";
    echo "<button type='submit' name='func' value='insert_product_car' class='btn btn-success'><font color='white'>新增車種</font></button>";
    echo "<button type='submit' name='func' value='update_product_car' class='btn btn-warning'><font color='white' >修改</font></button>";
    echo "<button type='submit' name='func' value='delete_action_product_car' class='btn btn-danger'><font color='white'>刪除</font></button>";
    echo "<button type='submit' name='func' value='select_product_car' class='btn btn-danger'><font color='white'>查詢</font></button>";
    echo "</form>";
    
    //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_product_manager.php' method='POST'>
           <button type='submit'  name='product' value='$product' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_product_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='product' value='$product' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    echo "<br><br>";
    }else if($product=='compon'){
          require 'mysql.php';
    $db=Database::initDB();
    echo "<h1>零組件清單<h1>";
    $sql="select * From 零組件 order by 零組件id";
    $result=$db->query($sql);
    echo "<form action=index1.php method=POST>";
    echo "<table  class='table table-striped'>";
    echo "<tr style='color:black;'><td></td><td>零組件id</td><td>料號</td><td>零件名稱</td><td>單價</td><td>庫存</td><td>成本價</td></tr>";        

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
            
               $sql="select * From 零組件 order by 零組件id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)
    {
       echo "<tr style='color:black;'><td><input type=radio name=product_id value=$row[零組件id]></td><td>$row[零組件id]</td><td>$row[料號]</td><td>$row[零件名稱]</td><td>$row[單價]</td><td>$row[庫存]</td><td>$row[成本價]</td></tr>";        
    }
    echo "</table>";
    echo "<button type='submit' name='func' value='insert_product_compon' class='btn btn-success'><font color='white'>新增零組件</font></button>";
    echo "<button type='submit' name='func' value='update_product_compon' class='btn btn-warning'><font color='white' >修改</font></button>";
    echo "<button type='submit' name='func' value='delete_action_product_compon' class='btn btn-danger'><font color='white'>刪除</font></button>";
    echo "<button type='submit' name='func' value='select_product_compon' class='btn btn-danger'><font color='white'>查詢</font></button>";
    echo "</form>";
    
     //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_product_manager.php' method='POST'>
           <button type='submit'  name='product' value='$product' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_product_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='product' value='$product' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    echo "<br><br>";
    }else if($product=='care'){
          require 'mysql.php';
    $db=Database::initDB();
    echo "<h1>保養品清單<h1>";
    $sql="select * From 保養品 order by 保養品id";
    $result=$db->query($sql);
    echo "<form action=index1.php method=POST>";   
    echo "<table  class='table table-striped'>";
    echo "<tr style='color:black;'><td></td><td>保養品id</td><td>保養品名稱</td><td>單價</td><td>成本價</td><td>庫存</td></tr>";        


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
            
               $sql="select * From 保養品 order by 保養品id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)
    {
       
       echo "<tr style='color:black;'><td><input type=radio name=product_id value=$row[保養品id]></td><td>$row[保養品id]</td><td>$row[保養品名稱]</td><td>$row[單價]</td><td>$row[成本價]</td><td>$row[庫存]</td></tr>";        
    }
    echo "</table>";
    echo "<button type='submit' name='func' value='insert_product_care' class='btn btn-success'><font color='white'>新增保養品</font></button>";
    echo "<button type='submit' name='func' value='update_product_care' class='btn btn-warning'><font color='white' >修改</font></button>";
    echo "<button type='submit' name='func' value='delete_action_product_care' class='btn btn-danger'><font color='white'>刪除</font></button>";
    echo "<button type='submit' name='func' value='select_product_care' class='btn btn-danger'><font color='white'>查詢</font></button>";
    echo "</form>";
    
    //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_product_manager.php' method='POST'>
           <button type='submit'  name='product' value='$product' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_product_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='product' value='$product' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
        
    }
   
   
?>