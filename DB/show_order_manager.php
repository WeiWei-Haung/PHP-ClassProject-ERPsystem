<?php

session_start();
  echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>
                     ";
   
   echo "<form action=show_order_manager.php method=POST>";
    echo "<select name='order' style='color:black;'><font color='black'><option value='car' style='color:black;'>車輛訂單</option><option value='compon' style='color:black;'>零組件訂單</font></option><option value='care' style='color:black;'>保養品訂單</option></font></option><option value='repair' style='color:black;'>維修訂單</option></font><option value='refit' style='color:black;'>改裝訂單</option></font></select>";
    echo "<input type='submit' value='送出'/>";
    echo "</form>";
 $order=$_POST['order'];
    echo "<form action='index1.php' method=POST align='right'>";
    echo "<nav class='navbar navbar-default' role='navigation'><ul class='nav nav-pills'> <li role='presentation' class='active'><font color='black'>";
    echo  $_SESSION['name'] . " </font></li> <li role='presentation'><font color='black'>您好  身分:" .       $_SESSION['ident'] . "</font></li>  " . "    <li role='presentation'><button  name='func' type='submit' value='logout_action' class='btn btn-danger'><span class='glyphicon glyphicon-share' aria-hidden='true'>登出</span></button><br><br></li><li role='presentation'><button  name='func' type='submit' value='show_homepage' class='btn btn-danger'><span class='glyphicon glyphicon-home' aria-hidden='true'>首頁</span></button><br><br></li></ul></nav>";
    echo "</form><br><br>";
    
    if($order=='car'){
    require 'mysql.php';
    $db=Database::initDB();
    //車輛
    echo "<h1>車輛訂單<h1>";
    $sql="SELECT 車輛訂單id, 交易日期, 備註, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 車輛訂單 JOIN 員工 ON 車輛訂單.員工id = 員工.員工id JOIN 客戶 ON 車輛訂單.客戶id = 客戶.客戶id";
    $result=$db->query($sql);
    
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td>車輛訂單id</td><td>交易日期</td><td>備註</td><td>員工姓名</td><td>客戶姓名</td></tr>";        

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
            
               $sql="SELECT 車輛訂單id, 交易日期, 備註, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 車輛訂單 JOIN 員工 ON 車輛訂單.員工id = 員工.員工id JOIN 客戶 ON 車輛訂單.客戶id = 客戶.客戶id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);



    foreach($result->fetchAll() as $row)
    {
       
       echo "<tr><td><input type=radio name=order_id value=$row[車輛訂單id]></td><td>$row[車輛訂單id]</td><td>$row[交易日期]</td><td>$row[備註]</td><td>$row[員工姓名]</td><td>$row[客戶姓名]</td></tr>";      
    }
    echo "<tr><td>明細新增筆數:</td><td><input  type=text name=count value=1></td><td><button type='submit' name='func' value='insert_order_car' class='btn btn-success'>新增車輛訂單</button></td>";
    echo "<td><button type='submit' name='func' value='look_order_car' class='btn btn-warning'>查看明細</button></td>";
    echo "<td><button type='submit' name='func' value='delete_action_order_car' class='btn btn-danger'>刪除</button></td><td></td></tr>";
    echo "</table></form>";
    
    
     //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_order_manager.php' method='POST'>
           <button type='submit'  name='order' value='car' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_order_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='order' value='$order' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    
    echo "<br><br>";
    
    
    
    
    

    }else if($order=='compon'){
    require 'mysql.php';
    $db=Database::initDB();
   //零組件
    echo "<h1>零組件訂單<h1>";
    $sql="SELECT 零組件訂單id, 交易日期, 備註, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 零組件訂單 JOIN 員工 ON 零組件訂單.員工id = 員工.員工id JOIN 客戶 ON 零組件訂單.客戶id = 客戶.客戶id";
    $result=$db->query($sql);
    
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td>零組件訂單id</td><td>交易日期</td><td>員工姓名</td><td>客戶姓名</td><td></td></tr>";    

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
            
               $sql="SELECT 零組件訂單id, 交易日期, 備註, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 零組件訂單 JOIN 員工 ON 零組件訂單.員工id = 員工.員工id JOIN 客戶 ON 零組件訂單.客戶id = 客戶.客戶id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)        {
       
       echo "<tr><td><input type=radio name=compon_id value=$row[零組件訂單id]></td><td>$row[零組件訂單id]</td><td>$row[交易日期]</td><td>$row[員工姓名]</td><td>$row[客戶姓名]</td><td></td></tr>";        
    }
    echo "<tr><td>明細新增筆數:</td><td><input  type=text name=count value=1></td><td><button type='submit' name='func' value='insert_order_compon' class='btn btn-success'>新增零組件訂單</button></td>";
    echo "<td><button type='submit' name='func' value='look_order_compon' class='btn btn-warning'>查看明細</button></td>";
    echo "<td><button type='submit' name='func' value='delete_action_order_compon' class='btn btn-danger'>刪除</button></td><td></td></tr>";
    echo "</table></form>";
    
      //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_order_manager.php' method='POST'>
           <button type='submit'  name='order' value='$order' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_order_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='order' value='$order' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    
    echo "<br><br>";
    
    
    echo "<br><br>";
    }else if($order=='care'){
    require 'mysql.php';
    $db=Database::initDB();
    //保養品
    echo "<h1>保養品訂單<h1>";
    
    $sql="SELECT 保養品訂單id, 交易日期, 備註, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 保養品訂單 JOIN 員工 ON 保養品訂單.員工id = 員工.員工id JOIN 客戶 ON 保養品訂單.客戶id = 客戶.客戶id";
    $result=$db->query($sql);
    
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td>保養品訂單id</td><td>交易日期</td><td>備註</td><td>員工姓名</td><td>客戶姓名</td></tr>";        

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
            
               $sql="SELECT 保養品訂單id, 交易日期, 備註, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 保養品訂單 JOIN 員工 ON 保養品訂單.員工id = 員工.員工id JOIN 客戶 ON 保養品訂單.客戶id = 客戶.客戶id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);



    foreach($result->fetchAll() as $row)    {
       
       echo "<tr><td><input type=radio name=care_id value=$row[保養品訂單id]></td><td>$row[保養品訂單id]</td><td>$row[交易日期]</td><td>$row[備註]</td><td>$row[員工姓名]</td><td>$row[客戶姓名]</td></tr>";        
    }
    echo "<tr><td>明細新增筆數:</td><td><input  type=text name=count value=1></td><td><button type='submit' name='func' value='insert_order_care' class='btn btn-success'>新增保養品訂單</button></td>";
    echo "<td><button type='submit' name='func' value='look_order_care' class='btn btn-warning'>查看明細</button></td>";
    echo "<td><button type='submit' name='func' value='delete_action_order_care' class='btn btn-danger'>刪除</button></td><td></td></tr>";
    echo "</table></form>";
    
    //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_order_manager.php' method='POST'>
           <button type='submit'  name='order' value='$order' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_order_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='order' value='$order' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    echo "<br><br>";
}else if($order=='repair'){
    require 'mysql.php';
    $db=Database::initDB();
    //維修訂單
    echo "<h1>維修訂單<h1>";
    
    $sql="SELECT 維修訂單id, 維修服務價格, 維修日期, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 維修訂單 JOIN 員工 ON 維修訂單.員工id = 員工.員工id
JOIN 客戶 ON 維修訂單.客戶id = 客戶.客戶id";
    $result=$db->query($sql);
    
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td>維修訂單id</td><td>維修服務價格</td><td>員工姓名</td><td>客戶姓名</td><td>維修日期</td></tr>";        

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
            
               $sql="SELECT 維修訂單id, 維修服務價格, 維修日期, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 維修訂單 JOIN 員工 ON 維修訂單.員工id = 員工.員工id JOIN 客戶 ON 維修訂單.客戶id = 客戶.客戶id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)    {
       
       echo "<tr><td><input type=radio name=repair_id value=$row[維修訂單id]></td><td>$row[維修訂單id]</td><td>$row[維修服務價格]</td><td>$row[員工姓名]</td><td>$row[客戶姓名]</td><td>$row[維修日期]</td></tr>";        
    }
    echo "<tr><td>明細新增筆數:</td><td><input  type=text name=count value=1></td><td><button type='submit' name='func' value='insert_order_repair' class='btn btn-success'>新增維修訂單</button></td>";
    echo "<td><button type='submit' name='func' value='look_order_repair' class='btn btn-warning'>查看明細</button></td>";
    echo "<td><button type='submit' name='func' value='update_order_repair_money' class='btn btn-warning'>修改維修金額</button></td>";
    echo "<td><button type='submit' name='func' value='delete_action_order_repair' class='btn btn-danger'>刪除</button></td><td></td></tr>";
    echo "</table></form>";
    
     //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_order_manager.php' method='POST'>
           <button type='submit'  name='order' value='$order' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_order_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='order' value='$order' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    echo "<br><br>";


}else if($order=='refit'){
    require 'mysql.php';
    $db=Database::initDB();
    //改裝訂單
    echo "<h1>改裝訂單<h1>";
    
    $sql="SELECT 改裝訂單id, 改裝服務價格, 改裝日期, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 改裝訂單 JOIN 員工 ON 改裝訂單.員工id = 員工.員工id JOIN 客戶 ON 改裝訂單.客戶id = 客戶.客戶id";
    $result=$db->query($sql);
    
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
    echo "<tr><td></td><td>改裝訂單id</td><td>改裝服務價格</td><td>員工姓名</td><td>客戶姓名</td><td>改裝日期</td></tr>";        

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
            
               $sql="SELECT 改裝訂單id, 改裝服務價格, 改裝日期, 員工.姓名 AS 員工姓名, 客戶.姓名 AS 客戶姓名 FROM 改裝訂單 JOIN 員工 ON 改裝訂單.員工id = 員工.員工id JOIN 客戶 ON 改裝訂單.客戶id = 客戶.客戶id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);

    foreach($result->fetchAll() as $row)    {
       
       echo "<tr><td><input type=radio name=refit_id value=$row[改裝訂單id]></td><td>$row[改裝訂單id]</td><td>$row[改裝服務價格]</td><td>$row[員工姓名]</td><td>$row[客戶姓名]</td><td>$row[改裝日期]</td></tr>";        
    }
    echo "<tr><td>明細新增筆數:</td><td><input  type=text name=count value=1></td><td><button type='submit' name='func' value='insert_order_refit' class='btn btn-success'>新增改裝訂單</button></td>";
    echo "<td><button type='submit' name='func' value='look_order_refit' class='btn btn-warning'>查看明細</button></td>";
    echo "<td><button type='submit' name='func' value='update_order_refit_money' class='btn btn-warning'>修改改裝金額</button></td>";
    echo "<td><button type='submit' name='func' value='delete_action_order_refit' class='btn btn-danger'>刪除</button></td><td></td></tr>";
    echo "</table></form>";
    
    //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='show_order_manager.php' method='POST'>
           <button type='submit'  name='order' value='$order' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='show_order_manager.php' method='POST'>";
            echo  " <td><button type='submit' name='order' value='$order' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    echo "<br><br>";


}
?>