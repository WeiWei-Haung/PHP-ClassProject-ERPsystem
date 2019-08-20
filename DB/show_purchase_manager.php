<?php
session_start();
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    
    echo "<form action=show_purchase_manager.php method=POST >";
    echo "<select name='purchase' style='color:black;'><font color='black'><option value='car' style='color:black;'>車輛採購單</option><option value='compon' style='color:black;'>零組件採購單</font></option><option value='care' style='color:black;'>保養品採購單</option></font></switch>";
    echo "<input type='submit' value='送出'/>";
    echo "</form>";
    echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>
                     ";
    $purchase=$_POST['purchase'];
    
    echo "<form action='index1.php' method=POST align='right'>";
    echo "<nav class='navbar navbar-default' role='navigation'><ul class='nav nav-pills'> <li role='presentation' class='active'><font color='black'>";
    echo  $_SESSION['name'] . " </font></li> <li role='presentation'><font color='black'>您好  身分:" .       $_SESSION['ident'] . "</font></li>  " . "    <li role='presentation'><button  name='func' type='submit' value='logout_action' class='btn btn-danger'><span class='glyphicon glyphicon-share' aria-hidden='true'>登出</span></button><br><br></li><li role='presentation'><button  name='func' type='submit' value='show_homepage' class='btn btn-danger'><span class='glyphicon glyphicon-home' aria-hidden='true'>首頁</span></button><br><br></li></ul></nav>";
    echo "</form><br><br>";
    //車輛
    if($purchase=='car'){
             require 'mysql.php';
    $db=Database::initDB();
    
    echo "<h1>車輛採購單<h1>";
    $sql="select * From 車輛進貨單 join 供應商 on 車輛進貨單.供應商id=供應商.供應商id order by 交易日期";
    $result=$db->query($sql);
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td>車輛進貨單id</td><td>供應商名稱</td><td>供應商電話</td><td>交易日期</td></tr>";        
 
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
            
               $sql="select * From 車輛進貨單 join 供應商 on 車輛進貨單.供應商id=供應商.供應商id order by 交易日期 LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)
    {
       
       echo "<tr><td><input type=radio name=purchase__id value=$row[車輛進貨單id]></td><td>$row[車輛進貨單id]</td><td>$row[供應商名稱]</td><td>$row[電話]</td><td>$row[交易日期]</td></tr>";        
    }
    echo "<tr><td>明細新增筆數:</td><td><input  type=text name=count value=1></td><td><button type='submit' name='func' value='insert_purchase_car' class='btn btn-success'>新增車輛進貨單</button></td>";
    echo "<td><button type='submit' name='func' value='look_purchase_car' class='btn btn-warning'>查看明細</button></td>";
    echo "<td><button type='submit' name='func' value='delete_action_purchase_car' class='btn btn-danger'>刪除</button></td></tr>";
    echo "</table></form>";
    
      //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_purchase_manager.php' method='POST'>
           <button type='submit'  name='purchase' value='$purchase' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_purchase_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='purchase' value='$purchase' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    echo "<br><br>";
    
    }else if($purchase=='compon'){
    //零組件
          require 'mysql.php';
    $db=Database::initDB();
    echo "<h1>零組件採購單<h1>";
    $sql="select * From 零組件進貨單 join 供應商 on 零組件進貨單.供應商id=供應商.供應商id order by 交易日期";
    $result=$db->query($sql);
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td>零組件進貨單id</td><td>供應商名稱</td><td>供應商電話</td><td>交易日期</td></tr>";     


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
            
               $sql="select * From 零組件進貨單 join 供應商 on 零組件進貨單.供應商id=供應商.供應商id order by 交易日期 LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)
    {
       
       echo "<tr><td><input type=radio name=purchase__id value=$row[零組件進貨單id]></td><td>$row[零組件進貨單id]</td><td>$row[供應商名稱]</td><td>$row[電話]</td><td>$row[交易日期]</td></tr>"; 
    }
    echo "<tr><td>明細新增筆數:</td><td><input type=text name=count value=1></td><td><button type='submit' name='func' value='insert_purchase_compon' class='btn btn-success'>新增零組件訂單</button></td>";
    echo "<td><button type='submit' name='func' value='look_purchase_compon' class='btn btn-warning'>查看明細</button></td>";
    echo "<td><button type='submit' name='func' value='delete_action_purchase_compon' class='btn btn-danger'>刪除</button></td></tr>";
    echo "</table></form>";
    
    //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_purchase_manager.php' method='POST'>
           <button type='submit'  name='purchase' value='$purchase' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_purchase_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='purchase' value='$purchase' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    echo "<br><br>";
    }else if($purchase=='care'){
    //保養品
          require 'mysql.php';
    $db=Database::initDB();
    echo "<h1>保養品採購單<h1>";
    $sql="select * From 保養品進貨單 join 供應商 on 保養品進貨單.供應商id=供應商.供應商id order by 交易日期";
    $result=$db->query($sql);
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td>保養品進貨單id</td><td>供應商名稱</td><td>供應商電話</td><td>交易日期</td></tr>";        

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
            
               $sql="select * From 保養品進貨單 join 供應商 on 保養品進貨單.供應商id=供應商.供應商id order by 交易日期 LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)
    {
       
       echo "<tr><td><input type=radio name=purchase__id value=$row[保養品進貨單id]></td><td>$row[保養品進貨單id]</td><td>$row[供應商名稱]</td><td>$row[電話]</td><td>$row[交易日期]</td></tr>";        
    }
    echo "<tr><td>明細新增筆數:</td><td><input  type=text name=count value=1></td><td><button type='submit' name='func' value='insert_purchase_care' class='btn btn-success'>新增保養品進貨單</button></td>";
    echo "<td><button type='submit' name='func' value='look_purchase_care' class='btn btn-warning'>查看明細</button></td>";
    echo "<td><button type='submit' name='func' value='delete_action_purchase_care' class='btn btn-danger'>刪除</button></td></tr>";
    echo "</table></form>";
    
    //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_purchase_manager.php' method='POST'>
           <button type='submit'  name='purchase' value='$purchase' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_purchase_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='purchase' value='$purchase' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    }
    
    
    
    
?>