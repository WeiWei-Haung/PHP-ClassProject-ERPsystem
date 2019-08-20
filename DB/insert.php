<?php
    $fun=$_POST['func'];
    require 'mysql.php';    $db=Database::initDB();
    
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
    switch ($fun) {
        //新增客戶
        case 'insert_customer':
            
            echo "<form action=index1.php method=POST>
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的客戶資料:<td>
                            </tr>
                            <tr>
                                <td>姓名<input type=text name=name></td>
                                <td>電話<input type=text name=tel></td>
                            </tr>
                            <tr>
                                <td>地址<input type=text name=add></td>
                                <td>車牌號碼<input type=text name=carnum></td>
                            </tr>
                            <tr>
                                <td>性別<select name=gender><option value='男'>男</option><option value='女'>女</option></select></td>
                                <td>生日<input type=date name=birth></td>
                            </tr>
                            <tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_customer' class='btn btn-success'>送出</button></td>
                    </table>";
                            
            break;
            
             //新增供應商
        case 'insert_supplier':
            echo "<form action=index1.php method=POST>
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的供應商資料:<td>
                            </tr>
                            <tr>
                                <td>供應商名稱<input type=text name=name></td>
                                <td>電話<input type=text name=tel></td>
                            </tr>
                            <tr>
                                <td>地址<input type=text name=add></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_supplier' class='btn btn-success'>送出</button></td>
                    </table>";
                            
        break;
            
            
        //新增進貨單_車輛    
        case 'insert_purchase_car':
            $count=$_POST['count'];
            echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的車輛採購單資料:</td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>選擇供應商:";
                                 
    
                                echo '<select name="供應商id">';
                                $sql="select * From 供應商 order by 供應商id";      //選擇供應商下拉式選單內容
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[供應商id]>$row[供應商名稱]</option> ";        
                                }
                                echo "</select>
                            <td>交易日期<input type=date name=交易日期></td><td></td>
                            </tr>";
                                echo "<input type=hidden name=count value=$count>";//選擇車種的下拉式選單內容    
                            for ($i = 0; $i < $count; $i++) {                       
                                 echo '<tr><td>選擇車輛型號 <select name="車種[]">'; 
                                $sql="select * From 車種 order by 車種id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[車種id]>$row[型號]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>數量<input type=text name=數量[]></td><td>出廠日期<input type=date name=出廠日期[]></td></tr>";    
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_purchase_car' class='btn btn-success'>送出</button></td><td></td>
                            </tr>
                    </table>";
            break;
    
    //新增車種    
        case 'insert_product_car': 
                echo "<form action=index1.php method=POST enctype='multipart/form-data'>
                    <table class='table table-striped'><tr>
                                <td>請輸入新增車種名單資料:<td>
                            </tr>
                            <tr>
                                <td>型號<input type=text name='type'></td>
                                <td>排氣量<input type=text name='cc'></td>
                            </tr>
                            <tr>
                                <td>庫存<input type=text name='count'></td>
                                <td>單價<input type=text name='price'></td>
                            </tr>
                            <tr>
                                <td>成本<input type=text name='cost'></td>
                                <td>圖片<input type=file name='image'></td>
                            </tr>
                            <tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_product_car' class='btn btn-success'>送出</button></td>
                    </table>";
                            
            break;
    //新增零組件        
        case 'insert_product_compon': 
                echo "<form action=index1.php method=POST>
                    <table class='table table-striped'><tr>
                                <td>請輸入新增零組件資料:<td>
                            </tr>
                            <tr>
                                <td>料號<input type=text name='type'></td>
                                <td>零件名稱<input type=text name='name'></td>
                            </tr>
                            <tr>
                                <td>單價<input type=text name='price'></td>
                                <td>庫存<input type=text name='count'></td>
                            </tr>
                            <tr>
                                <td>成本價<input type=text name='cost'></td>
                                <td></td>
                            </tr>
                                
                            <tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_product_compon' class='btn btn-success'>送出</button></td>
                    </tr>
                    </table>";
                            
            break;
    //新增保養品        
             case 'insert_product_care': 
                echo "<form action=index1.php method=POST>
                    <table class='table table-striped'><tr>
                                <td>請輸入新增保養品資料:<td>
                            </tr>
                            <tr>
                                <td>保養品名稱<input type=text name='name'></td>
                                <td>單價<input type=text name='price'></td>
                            </tr>
                            <tr>
                                <td>庫存<input type=text name='count'></td>
                                <td>成本價<input type=text name='cost'></td>
                            </tr>
                           
                                
                            <tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_product_care' class='btn btn-success'>送出</button></td>
                    </tr>
                    </table>";
                            
            break;
            
        //新增進貨單_零組件    
            case 'insert_purchase_compon':
                $count=$_POST['count'];
                echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的零組件採購單資料:<td>
                            </tr>
                            <tr>
                                <td>選擇供應商:";
                                 
    
                                echo '<select name="供應商id">';
                                $sql="select * From 供應商 order by 供應商id";      //選擇供應商下拉式選單內容
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[供應商id]>$row[供應商名稱]</option> ";        
                                }
                                echo "</select>
                            <td>交易日期<input type=date name=交易日期></td>
                            </tr>";
                         
                                echo "<input type=hidden name=count value=$count>";//選擇車種的下拉式選單內容    
                            for ($i = 0; $i < $count; $i++) {                       
                                 echo '<tr><td>選擇零件<select name="零件[]">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零件名稱]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>數量<input type=text name=數量[]></td></td></tr>";    
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_purchase_compon' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
            break;
    
    
    //新增進貨單_保養品    
            case 'insert_purchase_care':
                $count=$_POST['count'];
                echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的保養品採購單資料:</td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>選擇供應商:";
                                 $db=Database::initDB();
    
                                echo '<select name="供應商id">';
                                $sql="select * From 供應商 order by 供應商id";      //選擇供應商下拉式選單內容
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[供應商id]>$row[供應商名稱]</option> ";        
                                }
                                echo "</select>
                            <td>交易日期<input type=date name=交易日期></td><td></td>
                            </tr>";
                         
                                echo "<input type=hidden name=count value=$count>";//選擇車種的下拉式選單內容    
                            for ($i = 0; $i < $count; $i++) {                       
                                 echo '<tr><td>選擇保養品<select name="保養品[]">'; 
                                $sql="select * From 保養品 order by 保養品id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[保養品id]>$row[保養品名稱]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>數量<input type=text name=數量[]></td><td>有效日期<input type=date name=有效日期[]></td></tr>";    
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_purchase_care' class='btn btn-success'>送出</button></td><td></td >
                            </tr>
                    </table>";
            break;
    
    //新增採購明細_車輛
                case 'insert_purchase_line_car':
                    $id=$_POST['purchase__id'];
                    $lid=$_POST['purchase_line_id'];
                    $count=$_POST['count'];
                     echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=purchase__id value=$id>";//傳送單號
                    echo " <input type=hidden name=purchase_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲新增的車輛採購單資料:</td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo "<input type=hidden name=count value=$count>";//選擇車種的下拉式選單內容    
                            for ($i = 0; $i < $count; $i++) {                       
                                 echo '<tr><td>選擇車輛型號 <select name="車種[]">'; 
                                $sql="select * From 車種 order by 車種id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[車種id]>$row[型號]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>數量<input type=text name=數量[]></td><td>出廠日期<input type=date name=出廠日期[]></td></tr>";    
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_purchase_line_car' class='btn btn-success'>送出</button></td><td></td>
                            </tr>
                    </table>";
                    break;
    
     //新增採購明細_零組件
                case 'insert_purchase_line_compon':
                    $id=$_POST['purchase__id'];
                    $lid=$_POST['purchase_line_id'];
                    $count=$_POST['count'];
                     echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=purchase__id value=$id>";//傳送單號
                    echo " <input type=hidden name=purchase_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲新增的零組件採購單資料:<td>
                            </tr>
                            <tr>";
                    echo "<input type=hidden name=count value=$count>";   
                            for ($i = 0; $i < $count; $i++) {                       //選擇零件的下拉式選單內容 
                                 echo '<tr><td>選擇零組件型號 <select name="零件[]">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零件名稱]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>數量<input type=text name=數量[]></td></tr>";    
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_purchase_line_compon' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                    break;
                
    
    //新增採購明細_保養品
                case 'insert_purchase_line_care':
                    $id=$_POST['purchase__id'];
                    $lid=$_POST['purchase_line_id'];
                    $count=$_POST['count'];
                     echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=purchase__id value=$id>";//傳送單號
                    echo " <input type=hidden name=purchase_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲新增的保養品採購單資料:<td>
                            </tr>
                            <tr>";
                    echo "<input type=hidden name=count value=$count>";   
                            for ($i = 0; $i < $count; $i++) {                       //選擇保養品的下拉式選單內容 
                                 echo '<tr><td>選擇保養品<select name="保養品[]">'; 
                                $sql="select * From 保養品 order by 保養品id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[保養品id]>$row[保養品名稱]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>數量<input type=text name=數量[]></td><td>有效日期<input type=date name=有效日期[]></td></tr>";    
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_purchase_line_care' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                    break;
    
              //新增員工
                case 'insert_employee':
                            echo "<form action=index1.php method=POST>
                        <table class='table table-striped'><tr>
                                <td>請輸入欲新增的員工資料:<td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>姓名<input type=text name='name'></td>
                                <td>住址<input type=text name='add'></td>
                                <td></td><td></td>
                            </tr>
                            <tr>
                                <td>生日<input type=date name='bir'></td>
                                <td>電話<input type=text name='tel'></td>
                                <td></td><td></td>
                            </tr>
                            <tr>
                                <td>";
                                    echo '選擇職稱<select name="office">'; 
                                    $sql="SELECT * FROM 職稱";
                                    $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[職稱id]>$row[職位名稱]</option> ";        
                                }
                                echo "</select>";
                                echo "</td>
                                <td>任職起始日<input type=date name='date1'></td>
                                <td>任職結束日<input type=date name='date2'></td>
                            </tr>
                            <tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_employee' class='btn btn-success'>送出</button></td><td></td><td></td>
                    </table>";
                            
            break;
            
        //新增員工任職明細
            case 'insert_employee_office':
               // $employee_office_id=$_POST['employee_office_id'];//明細id
                $employee_id=$_POST['employee_id'];//員工id
                
               
                 echo "<form action=index1.php method=POST>
                        <table class='table table-striped'><tr>";
                echo "<input type=hidden name=employee_id value=$employee_id>
                                <td>請輸入欲新增的員工任職資料:<td><td></td><td></td>
                            </tr><tr><td>";
                echo '選擇職稱<select name="office">'; 
                                    $sql="SELECT * FROM 職稱";
                                    $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[職稱id]>$row[職位名稱]</option> ";        
                                }
                                echo "</select>";
                                echo "</td>
                                <td>任職起始日<input type=date name='date1'></td>
                                <td>任職結束日<input type=date name='date2'></td>
                            </tr>
                            <tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_employee_office' class='btn btn-success'>送出</button></td><td></td><td></td>
                    </table></form>";            
                break;
    
        //新增訂單_車輛
                case 'insert_order_car':
                $count=$_POST['count'];
                echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的車種資料:</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>選擇員工:";
    
                                echo '<select name="員工id">';
                                $sql="select * From 員工 order by 員工id";      //選擇供應商下拉式選單內容
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[員工id]>$row[員工id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                                
                                <td>選擇客戶:";
                                 
                                echo '<select name="客戶id">';
                                $sql="select * From 客戶 order by 客戶id";      //選擇供應商下拉式選單內容
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[客戶id]>$row[客戶id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                            
                            <td>交易日期<input type=date name=交易日期></td><td>單據備註<input type=textarea name=備註1></td>
                            </tr>";
                         
                                echo "<input type=hidden name=count value=$count>";
                               
                            for ($i = 0; $i < $count; $i++) {                       //選擇車種的下拉式選單內容    
                                 echo '<tr><td>選擇車種:<select name="車種[]">'; 
                                $sql="select * From 車種 order by 車種id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[車種id]>$row[型號]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>車牌號碼<input type=text name=車牌號碼[]></td><td>明細備註<input type=textarea name=備註2[]></td><td></td></tr>";    
                                echo "</td><td>交車日期<input type=date name=交車日期[]></td><td>保固日期<input type=date name=保固日期[]></td><td></td><td></td></tr>";
                                echo "</td><td></td><td></td><td></td><td></td></tr>"; 
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_car' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
            break;
        //保養品訂單
        case 'insert_order_care';
             $count=$_POST['count'];
                echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的保養品資料:</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>選擇員工:";
    
                                echo '<select name="員工id">';
                                $sql="select * From 員工 order by 員工id";      //選擇供應商下拉式選單內容
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[員工id]>$row[員工id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                                
                                <td>選擇客戶:";
                                 
                                echo '<select name="客戶id">';
                                $sql="select * From 客戶 order by 客戶id";      //選擇供應商下拉式選單內容
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[客戶id]>$row[客戶id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                            
                            <td>交易日期<input type=date name=交易日期></td><td>單據備註<input type=textarea name=備註1></td>
                            </tr>";
                         
                                echo "<input type=hidden name=count value=$count>";
                               
                            for ($i = 0; $i < $count; $i++) {                       //選擇車種的下拉式選單內容    
                                 echo '<tr><td>選擇保養品:<select name="保養品[]">'; 
                                $sql="select * From 保養品 order by 保養品id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[保養品id]>$row[保養品名稱]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>數量<input type=text name=數量[]></td>
                                        <td></td><td></td></tr>";    
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_care' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
            break;
    //零組件訂單
     case 'insert_order_compon':
                $count=$_POST['count'];
                echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的零組件資料:</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>選擇員工:";
    
                                echo '<select name="員工id">';
                                $sql="select * From 員工 order by 員工id";      //選擇供應商下拉式選單內容
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[員工id]>$row[員工id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                                
                                <td>選擇客戶:";
                                 
                                echo '<select name="客戶id">';
                                $sql="select * From 客戶 order by 客戶id";      //選擇客戶下拉式選單內容
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[客戶id]>$row[客戶id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                            
                            <td>交易日期<input type=date name=交易日期></td><td>單據備註<input type=textarea name=備�����1></td>
                            </tr>";
                         
                                echo "<input type=hidden name=count value=$count>";
                               
                            for ($i = 0; $i < $count; $i++) {                       //選擇零組件的下拉式選單內容    
                                 echo '<tr><td>選擇零組件:<select name="零組件[]">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零件名稱]</option> "; 
                                   
                                }
                                echo "</select>";
                                
                                echo "</td><td>數量<input type=text name=數量[]></td><td><td></td></td></tr>";    
                               
                                echo "</td><td></td><td></td><td></td><td></td></tr>"; 
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_compon' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
            break;
    
   //維修訂單
     case 'insert_order_repair':
                $count=$_POST['count'];
                echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的維修訂單資料:</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>選擇員工:";
    
                                echo '<select name="員工id">';
                                $sql="select * From 員工 order by 員工id";     
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[員工id]>$row[員工id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                                
                                <td>選擇客戶:";
                                 
                                echo '<select name="客戶id">';
                                $sql="select * From 客戶 order by 客戶id";      
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[客戶id]>$row[客戶id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                            
                            <td>維修服務價格<input type=text name=price></td><td>維修日期<input type=date name=date></td>
                            </tr>";
                         
                                echo "<input type=hidden name=count value=$count>";
                               
                            for ($i = 0; $i < $count; $i++) {                       //選擇零組件的下拉式選單內容    
                                 echo '<tr><td>選擇零組件:<select name="零組件[]">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零組件id] $row[零件名稱]</option> "; 
                                   
                                }
                                echo "</select>";
                                echo "</td><td>配件數量<input type=text name=數量[]></td><td></td><td></td></tr>";
                            }
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_repair' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
            break;
            
            //改裝訂單
     case 'insert_order_refit':
                $count=$_POST['count'];
                echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>
                                <td>請輸入欲新增的改裝訂單資料:</td><td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>選擇員工:";
    
                                echo '<select name="員工id">';
                                $sql="select * From 員工 order by 員工id";     
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[員工id]>$row[員工id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                                
                                <td>選擇客戶:";
                                 
                                echo '<select name="客戶id">';
                                $sql="select * From 客戶 order by 客戶id";      
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   echo "<option value=$row[客戶id]>$row[客戶id]  $row[姓名]</option> ";        
                                }
                                echo "</select>
                            
                            <td>改裝服務價格<input type=text name=price></td><td>改裝日期<input type=date name=date></td>
                            </tr>";
                         
                                echo "<input type=hidden name=count value=$count>";
                               
                            for ($i = 0; $i < $count; $i++) {                       //選擇零組件的下拉式選單內容    
                                 echo '<tr><td>選擇零組件:<select name="零組件[]">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零組件id] $row[零件名稱]</option> "; 
                                   
                                }
                                echo "</select>";
                                echo "</td><td>配件數量<input type=text name=數量[]></td><td></td><td></td></td></tr>";
                            }
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_refit' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
            break;
    
    //新增訂單明細_車輛
                case 'insert_order_line_car':
                    $id=$_POST['order__id'];
                    $lid=$_POST['order_line_id'];
                    $count=$_POST['count'];
                     echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲新增的車輛採購單資料:</td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo "<input type=hidden name=count value=$count>";   
                             for ($i = 0; $i < $count; $i++) {                       //選擇車種的下拉式選單內容    
                                 echo '<tr><td>選擇車種:<select name="車種[]">'; 
                                $sql="select * From 車種 order by 車種id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[車種id]>$row[型號]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>車牌號碼<input type=text name=車牌號碼[]></td><td>明細備註<input type=textarea name=備註2[]></td><td></td></tr>";    
                                echo "</td><td>交車日期<input type=date name=交車日期[]></td><td>保固日期<input type=date name=保固日期[]></td><td></td><td></td></tr>";
                                echo "</td><td></td><td></td><td></td><td></td></tr>"; 
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_line_car' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
                    break;
    
    
     //新增訂單明細_零組件
                case 'insert_order_line_compon':
                    $id=$_POST['order__id'];
                    $lid=$_POST['order_line_id'];
                    $count=$_POST['count'];
                     echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲新增的零組件訂單資料:</td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo "<input type=hidden name=count value=$count>";   
                             for ($i = 0; $i < $count; $i++) {                       //選擇零組件的下拉式選單內容    
                                 echo '<tr><td>選擇零組件:<select name="零組件[]">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零件名稱]</option> ";        
                                }
                                echo "</select>";
                                
                                 echo "</td><td>數量<input type=text name=數量[]></td><td><td></td></td></tr>";   
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_line_compon' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
                    break;
    
     //新增訂單明細_保養品
                case 'insert_order_line_care':
                    $id=$_POST['order__id'];
                    $lid=$_POST['order_line_id'];
                    $count=$_POST['count'];
                     echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲新增的保養品訂單資料:</td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo "<input type=hidden name=count value=$count>";   
                             for ($i = 0; $i < $count; $i++) {                       //選擇車種的下拉式選單內容    
                                 echo '<tr><td>選擇保養品:<select name="保養品[]">'; 
                                $sql="select * From 保養品 order by 保養品id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[保養品id]>$row[保養品名稱]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>數量<input type=text name=數量[]></td></tr>";    
                               
                           
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_line_care' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
                    break;
    
     //新增維修訂單明細
                case 'insert_order_line_repair':
                    $id=$_POST['repair__id'];
                    $lid=$_POST['order_line_id'];
                    $count=$_POST['count'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲新增的維修單明細資料:</td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo "<input type=hidden name=count value=$count>";   
                             for ($i = 0; $i < $count; $i++) {                       //選擇車種的下拉式選單內容    
                                 echo '<tr><td>選擇零組件:<select name="零件[]">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零件名稱]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>配件數量<input type=num name=數量[]></td><td></td><td></td></tr>";    
                              
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_line_repair' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
                    break;
    
    
    //新增改裝訂單明細
                case 'insert_order_line_refit':
                    $id=$_POST['refit__id'];
                    $lid=$_POST['order_line_id'];
                    $count=$_POST['count'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲新增的改裝單明細資料:</td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo "<input type=hidden name=count value=$count>";   
                             for ($i = 0; $i < $count; $i++) {                       //選擇車種的下拉式選單內容    
                                 echo '<tr><td>選擇零組件:<select name="零件[]">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零件名稱]</option> ";        
                                }
                                echo "</select>";
                                
                                echo "</td><td>配件數量<input type=num name=數量[]></td><td></td><td></td></tr>";    
                              
                            }
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='insert_action_order_line_refit' class='btn btn-success'>送出</button></td><td></td><td></td>
                            </tr>
                    </table>";
                    break;
    
    
    
    
    
    
    
    }
    
    
?>
