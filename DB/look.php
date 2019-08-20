<?php
session_start();
   require 'mysql.php';
    $db=Database::initDB();
     echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>";
                     echo "<form action='index1.php' method=POST align='right'>";
    echo "<nav class='navbar navbar-default' role='navigation'><ul class='nav nav-pills'> <li role='presentation' class='active'><font color='black'>";
    echo  $_SESSION['name'] . " </font></li> <li role='presentation'><font color='black'>您好  身分:" .       $_SESSION['ident'] . "</font></li>  " . "    <li role='presentation'><button  name='func' type='submit' value='logout_action' class='btn btn-danger'><span class='glyphicon glyphicon-share' aria-hidden='true'>登出</span></button><br><br></li><li role='presentation'><button  name='func' type='submit' value='show_homepage' class='btn btn-danger'><span class='glyphicon glyphicon-home' aria-hidden='true'>首頁</span></button><br><br></li></ul></nav>";
    echo "</form><br><br>";
                     
    $func=$_POST['func'];
//查看車輛採購單明細    
    switch ($func) {
        case 'look_purchase_car':
            
            $id=$_POST['purchase__id'];
            
             if (isset($_POST["id"])){
            $id=$_POST['id'];   
             }
            
            $sql="SELECT * FROM 車輛供應明細 join 車種 on 車輛供應明細.車種id=車種.車種id WHERE 車輛進貨單id = $id";
            $result=$db->query($sql);
            echo "<form action=index1.php method=POST>";   
            echo "<table class='table table-striped'>";
            echo "<tr><td></td><td>型號</td><td>排氣量</td><td>成本價</td><td>數量</td><td>出廠日期</td></tr>";        
            echo "<input type=hidden name=purchase__id value=$id>"; //將單號傳過去
            
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
            
               $sql="SELECT * FROM 車輛供應明細 join 車種 on 車輛供應明細.車種id=車種.車種id WHERE 車輛進貨單id = $id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);
            
                    foreach($result->fetchAll() as $row)
            {
               
               echo "<tr><td><input type=radio name=purchase_line_id value=$row[車輛供應明細id]></td><td>$row[型號]</td><td>$row[排氣量]</td><td>$row[成本價]</td><td>$row[數量]</td><td>$row[出廠日期]</td></tr>";        
            }
            echo "<tr><td><td>明細新增筆數:</td><td><input  type=text name=count value=1><button type='submit' name='func' value='insert_purchase_line_car' class='btn btn-success'>新增</button></td>";
            echo "<td><button type='submit' name='func' value='update_purchase_line_car' class='btn btn-warning'>修改</button></td>";
            echo "<td><button type='submit' name='func' value='delete_action_purchase_line_car' class='btn btn-danger'>刪除</button></td><td></td></tr>";
            echo "</table></form>";
   
       //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='look.php' method='POST'>
           <button type='submit' name='func' value='look_purchase_car' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='look.php' method='POST'>";
            echo  " <td><button type='submit' name='func' value='look_purchase_car' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
   
    break;
        
       
//查看零組件採購單明細
        case 'look_purchase_compon':
            $id=$_POST['purchase__id'];//接收進貨單號
             
              if (isset($_POST["id"])){
            $id=$_POST['id'];   
             }
             
            $sql="SELECT * FROM 零件供應明細 join 零組件 on 零件供應明細.零組件id=零組件.零組件id WHERE 零組件進貨單id = $id";
            $result=$db->query($sql);
            echo "<form action=index1.php method=POST>";   
            echo "<table class='table table-striped'>";
            echo "<tr><td></td><td>料號</td><td>零件名稱</td><td>成本價</td><td>數量</td></tr>";        
            echo "<input type=hidden name=purchase__id value=$id>"; //將單號傳過去
            
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
            
               $sql="SELECT * FROM 零件供應明細 join 零組件 on 零件供應明細.零組件id=零組件.零組件id WHERE 零組件進貨單id = $id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);
            
                    foreach($result->fetchAll() as $row)
            {
               
               echo "<tr><td><input type=radio name=purchase_line_id value=$row[零件供應明細id]></td><td>$row[料號]</td><td>$row[零件名稱]</td><td>$row[成本價]</td><td>$row[數量]</td></tr>";        
            }
            echo "<tr><td><td>明細新增筆數:</td><td><input  type=text name=count value=1><button type='submit' name='func' value='insert_purchase_line_compon' class='btn btn-success'>新增</button></td>";
            echo "<td><button type='submit' name='func' value='update_purchase_line_compon' class='btn btn-warning'>修改</button></td>";
            echo "<td><button type='submit' name='func' value='delete_action_purchase_line_compon' class='btn btn-danger'>刪除</button></td></tr>";
            echo "</table></form>";
            
               //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='look.php' method='POST'>
           <button type='submit' name='func' value='look_purchase_compon' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='look.php' method='POST'>";
            echo  " <td><button type='submit' name='func' value='look_purchase_compon' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
            
    break;
    
    
    //查看保養品採購單明細
        case 'look_purchase_care':
            $id=$_POST['purchase__id'];//接收進貨單號
            
             if (isset($_POST["id"])){
            $id=$_POST['id'];   
             }
            
            $sql="SELECT * FROM 保養品供應明細 join 保養品 on 保養品供應明細.保養品id=保養品.保養品id WHERE 保養品進貨單id = $id";
            $result=$db->query($sql);
            echo "<form action=index1.php method=POST>";   
            echo "<table class='table table-striped'>";
            echo "<tr><td></td><td>保養品名稱</td><td>成本價</td><td>數量</td><td>有效日期</td></tr>";        
            echo "<input type=hidden name=purchase__id value=$id>"; //將單號傳過去
            
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
            
               $sql="SELECT * FROM 保養品供應明細 join 保養品 on 保養品供應明細.保養品id=保養品.保養品id WHERE 保養品進貨單id = $id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);
            
                    foreach($result->fetchAll() as $row)
            {
               
               echo "<tr><td><input type=radio name=purchase_line_id value=$row[保養品供應明細id]></td><td>$row[保養品名稱]</td><td>$row[成本價]</td><td>$row[數量]</td><td>$row[有效日期]</td></tr>";        
            }
            echo "<tr><td><td>明細新增筆數:</td><td><input  type=text name=count value=1><button type='submit' name='func' value='insert_purchase_line_care' class='btn btn-success'>新增</button></td>";
            echo "<td><button type='submit' name='func' value='update_purchase_line_care' class='btn btn-warning'>修改</button></td>";
            echo "<td><button type='submit' name='func' value='delete_action_purchase_line_care' class='btn btn-danger'>刪除</button></td></tr>";
            echo "</table></form>";
            
             //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='look.php' method='POST'>
           <button type='submit' name='func' value='look_purchase_care' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='look.php' method='POST'>";
            echo  " <td><button type='submit' name='func' value='look_purchase_care' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
            
    break;
    
    //查看車輛訂單明細    
   
        case 'look_order_car':
            $id=$_POST['order_id'];
            
             if (isset($_POST["id"])){
            $id=$_POST['id'];   
             }
            
            $sql="SELECT * FROM 車輛訂單明細 join 車種 on 車輛訂單明細.車種id=車種.車種id WHERE 車輛訂單id = $id";
            $result=$db->query($sql);
            echo "<form action=index1.php method=POST>";   
            echo "<table class='table table-striped'>";
            echo "<tr><td></td><td>保固日期</td><td>交車日期</td><td>車牌號碼</td><td>備註</td><td>型號</td><td>排氣量</td><td>單價</td><td></td></tr>";        
            echo "<input type=hidden name=order__id value=$id>"; //將單號傳過去
            
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
            
               $sql="SELECT * FROM 車輛訂單明細 join 車種 on 車輛訂單明細.車種id=車種.車種id WHERE 車輛訂單id = $id LIMIT $per  OFFSET $start";
            $result = $db->query($sql);
            
            foreach($result->fetchAll() as $row)
            {
               
               echo "<tr><td><input type=radio name=order_line_id value=$row[車輛訂單�������細id]></td><td>$row[保固日期]</td><td>$row[交車日期]</td><td>$row[車牌號碼]</td><td>$row[備註]</td><td>$row[型號]</td><td>$row[排氣量]</td><td>$row[單價]</td><td></td></tr>";        
            }
            echo "<tr><td><td>明細新增筆數:</td><td><input  type=text name=count value=1><button type='submit' name='func' value='insert_order_line_car' class='btn btn-success'>新增</button></td>";
            echo "<td><button type='submit' name='func' value='update_order_line_car' class='btn btn-warning'>修改</button></td>";
            echo "<td><button type='submit' name='func' value='delete_action_order_line_car' class='btn btn-danger'>刪除</button></td><td></td><td></td><td></td><td></td></tr>";
            echo "</table></form>";
            
             //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='look.php' method='POST'>
           <button type='submit' name='func' value='look_order_car' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='look.php' method='POST'>";
            echo  " <td><button type='submit' name='func' value='look_order_car' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
            
    break;
    
    //查看零組件訂單明細    
    
        case 'look_order_compon':
            $id=$_POST['compon_id'];
            
            if (isset($_POST["id"])){
            $id=$_POST['id'];   
             }
            
            $sql="SELECT * FROM 零組件訂單明細 join 零組件 on 零組件訂單明細.零組件id=零組件.零組件id  WHERE 零組件訂單id = '$id'";
            $result=$db->query($sql);
            echo "<form action=index1.php method=POST>";   
            echo "<table class='table table-striped'>";
            echo "<tr><td></td><td>零件名稱</td><td>單價</td><td>數量</td><td></td></tr>";        
            echo "<input type=hidden name=order__id value=$id>"; //將單號傳過去
            
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
            
               $sql="SELECT * FROM 零組件訂單明細 join 零組件 on 零組件訂單明細.零組件id=零組件.零組件id  WHERE 零組件訂單id = '$id' LIMIT $per  OFFSET $start";
            $result = $db->query($sql);
            
            foreach($result->fetchAll() as $row)
            {
               
               echo "<tr><td><input type=radio name=order_line_id value=$row[零組件訂單明細id]></td><td>$row[零件名稱]</td><td>$row[單價]</td><td>$row[數量]</td><td></td></tr>";        
            }
            echo "<tr><td><td>明細新增筆數:</td><td><input  type=text name=count value=1><button type='submit' name='func' value='insert_order_line_compon' class='btn btn-success'>新增</button></td>";
            echo "<td><button type='submit' name='func' value='update_order_line_compon' class='btn btn-warning'>修改</button></td>";
            echo "<td><button type='submit' name='func' value='delete_action_order_line_compon' class='btn btn-danger'>刪除</button></td></tr>";
            echo "</table></form>";
    
     //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='look.php' method='POST'>
           <button type='submit' name='func' value='look_order_compon' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='look.php' method='POST'>";
            echo  " <td><button type='submit' name='func' value='look_order_compon' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    
    break;
    //查看保養品訂單明細 
        case 'look_order_care':
            $id=$_POST['care_id'];
             
            if (isset($_POST["id"])){
            $id=$_POST['id'];   
             }
            $sql="SELECT * FROM 保養品訂單明細 join 保養品 on 保養品訂單明細.保養品id=保養品.保養品id WHERE 保養品訂單id = '$id'";
            $result=$db->query($sql);
            echo "<form action=index1.php method=POST>";   
            echo "<table class='table table-striped'>";
            echo "<tr><td></td><td>保養品名稱</td><td>單價</td><td>數量</td><td></td></tr>";        
            echo "<input type=hidden name=order__id value=$id>"; //將單號傳過去
            
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
            
            $sql="SELECT * FROM 保養品訂單明細 join 保養品 on 保養品訂單明細.保養品id=保養品.保養品id WHERE 保養品訂單id = '$id' LIMIT $per  OFFSET $start";
            $result = $db->query($sql);
            
            foreach($result->fetchAll() as $row)
            {
               
               echo "<tr><td><input type=radio name=order_line_id value=$row[保養品訂單明細id]></td><td>$row[保養品名稱]</td><td>$row[單價]</td><td>$row[數量]</td><td></td></tr>";        
            }
            echo "<tr><td><td>明細新增筆數:</td><td><input  type=text name=count value=1><button type='submit' name='func' value='insert_order_line_care' class='btn btn-success'>新增</button></td>";
            echo "<td><button type='submit' name='func' value='update_order_line_care' class='btn btn-warning'>修改</button></td>";
            echo "<td><button type='submit' name='func' value='delete_action_order_line_care' class='btn btn-danger'>刪除</button></td></tr>";
            echo "</table></form>";
            
            //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='look.php' method='POST'>
           <button type='submit' name='func' value='look_order_care' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='look.php' method='POST'>";
            echo  " <td><button type='submit' name='func' value='look_order_care' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
    break;
    
    //查看維修訂單明細 
        case 'look_order_repair':
            $id=$_POST['repair_id'];
            if (isset($_POST["id"])){
            $id=$_POST['id'];   
             }
            $sql="SELECT * FROM 維修明細 left join 零組件 on 維修明細.零組件id=零組件.零組件id  LEFT join 維修訂單 on 維修明細.維修訂單id=維修訂單.維修訂單id WHERE 維修訂單.維修訂單id='$id'";
            $result=$db->query($sql);
            echo "<form action=index1.php method=POST>";   
            echo "<table class='table table-striped'>";
            echo "<tr><td></td><td>零件名稱</td><td>維修服務價格</td><td>配件數量</td><td>維修日期</td></tr>";        
            echo "<input type=hidden name=repair__id value=$id>"; //將單號傳過去
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
             
            $sql="SELECT * FROM 維修明細 left join 零組件 on 維修明細.零組件id=零組件.零組件id  LEFT join 維修訂單 on 維修明細.維修訂單id=維修訂單.維修訂單id WHERE 維修訂單.維修訂單id='$id' LIMIT $per  OFFSET $start";
            $result = $db->query($sql);
            
            foreach($result->fetchAll() as $row)
            {
               echo "<tr><td><input type=radio name=order_line_id value=$row[維修明細id]></td><td>$row[零件名稱]</td><td>$row[維修服務價格]</td><td>$row[配件數量]</td><td>$row[維修日期]</td></tr>";        
            }
            echo "<tr><td><td>明細新增筆數:</td><td><input  type=text name=count value=1><button type='submit' name='func' value='insert_order_line_repair' class='btn btn-success'>新增</button></td>";
            echo "<td><button type='submit' name='func' value='update_order_line_repair' class='btn btn-warning'>修改</button></td>";
            echo "<td><button type='submit' name='func' value='delete_action_order_line_repair' class='btn btn-danger'>刪除</button></td></tr>";
            echo "</table></form>";
           
           
           //分頁頁碼
    
    
          echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='look.php' method='POST'>
           <button type='submit' name='func' value='look_order_repair' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='look.php' method='POST'>";
            echo  " <td><button type='submit' name='func' value='look_order_repair' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
   
            break;
    
    
    //查看改裝訂單明細 
    case 'look_order_refit':

         $id=$_POST['refit_id'];
    if (isset($_POST["id"])){
     $id=$_POST['id'];   
    }
    
    $sql="SELECT * FROM 改裝明細 left join 零組件 on 改裝明細.零組件id=零組件.零組件id  LEFT join 改裝訂單 on 改裝明細.改裝訂單id=改裝訂單.改裝訂單id WHERE 改裝訂單.改裝訂單id='$id' ";
    $result=$db->query($sql);
    echo "<form action=index1.php method=POST>";   
    echo "<table class='table table-striped'>";
            echo "<tr><td></td><td>零件名稱</td><td>改裝服務價格</td><td>配件數量</td><td>改裝日期</td></tr>";        
    echo "<input type=hidden name=refit__id value=$id>"; //將單號傳過去
  
           
          
    $per= 5; //每頁顯示項目數量
     //取得不小於值的下一個整數
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
    $sql="SELECT * FROM `改裝明細` left join 零組件 on 改裝明細.零組件id=零組件.零組件id  LEFT join 改裝訂單 on 改裝明細.改裝訂單id=改裝訂單.改裝訂單id WHERE 改裝訂單.改裝���單id='$id' LIMIT $per  OFFSET $start";
    
    $result = $db->query($sql);
   
            foreach($result->fetchAll() as $row)
            {
               echo "<tr><td><input type=radio name=order_line_id value=$row[改裝明細id]></td><td>$row[零件名稱]</td><td>$row[改裝服務價格]</td><td>$row[配件數量]</td><td>$row[改裝日期]</td></tr>";        
            
                
            }
            echo "<tr><td><td>明細新增筆數:</td><td><input  type=text name=count value=1><button type='submit' name='func' value='insert_order_line_refit' class='btn btn-success'>新增</button></td>";
            echo "<td><button type='submit' name='func' value='update_order_line_refit' class='btn btn-warning'>修改</button></td>";
            echo "<td><button type='submit' name='func' value='delete_action_order_line_refit' class='btn btn-danger'>刪除</button></td></tr>";
            echo "</table></form>";
           
    //分頁頁碼
    
    
    echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='look.php' method='POST'>
           <button type='submit' name='func' value='look_order_refit' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='look.php' method='POST'>";
            echo  " <td><button type='submit' name='func' value='look_order_refit' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";

    break;
    
    
    
    
    //查看員工任職
        case 'look_employee':
            $employee_id=$_POST['employee_id'];
            
             if (isset($_POST["id"])){
             $employee_id=$_POST['id'];   
             }
            $sql="SELECT * FROM 員工 join 任職明細 on 員工.員工id=任職明細.員工id join 職稱 on 任職明細.職稱id=職稱.職稱id where 員工.員工id=$employee_id";
            $result=$db->query($sql);
            echo "<form action=index1.php method=POST>";   
            echo "<table class='table table-striped'>";
            echo "<tr><td></td><td>員工id</td><td>姓名</td><td>職位名稱</td><td>薪資</td><td>任職起始日</td><td>任職結束日</td></tr>";        
            
            echo "<input type=hidden name=employee_id value=$employee_id>";
            
              $per= 5; //每頁顯示項目數量
     //取得不小於值的下一個整數
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
    $sql="SELECT * FROM 員工 join 任職明細 on 員工.員工id=任職明細.員工id join 職稱 on 任職明細.職稱id=職稱.職稱id where 員工.員工id=$employee_id LIMIT $per  OFFSET $start";
    
    $result = $db->query($sql);
            
            foreach($result->fetchAll() as $row)
            {
               
               echo "<tr><td><input type=radio name=employee_office_id value=$row[任職明細id]></td><td>$row[員工id]</td><td>$row[姓名]</td><td>$row[職位名稱]</td><td>$row[薪資]</td><td>$row[任職起始日]</td><td>$row[任職結束日]</td></tr>";        
            }
            echo "</table>";
            echo "<button type='submit' name='func' value='insert_employee_office' class='btn btn-success'>新增</button></td>";
            echo "<button type='submit' name='func' value='update_employee_office' class='btn btn-warning'>修改</button></td>";
            echo "<button type='submit' name='func' value='delete_action_employee_office' class='btn btn-danger'>刪除</button></td></tr>";

            echo "</form>";
            
             //分頁頁碼
    
    
    echo '共 '. $pagenum .' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
   
    echo "<form action='look.php' method='POST'>
           <button type='submit' name='func' value='look_employee' page=1 class='btn btn-primary'>首頁</button>
           <input type='hidden' name='page' value='$page'/>
           <input type='hidden' name='num' value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$employee_id'/>
           </from>";

    echo "<table><tr><td>第</td> ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
     if ( $page-3 < $i && $i < $page+3 ) {
    echo"<form action='look.php' method='POST'>";
            echo  " <td><button type='submit' name='func' value='look_employee' class='btn btn-primary'>$i</button></td>
            
             <input type='hidden' name='page' value='$i'/>
              <input type='hidden' name=num value='$pagenum'/>
           <input type='hidden' name='pages' value='$pages'/>
           <input type='hidden' name='id' value='$employee_id'/></form>
             
             ";
            
        }}
    
    echo " <td>頁</td> </tr></table>";
            
            break;
    
    
    
    
    }
?>