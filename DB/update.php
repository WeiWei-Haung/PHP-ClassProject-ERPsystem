<?php
    require 'mysql.php';
    $fun=$_POST['func'];
    $db=Database::initDB();
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
   
    switch ($fun) {
    //修改客戶    
        case 'update_customer':
            $id=$_POST['customer_id'];
             $sql="SELECT * From 客戶 where 客戶id='$id'order by 客戶id";
             $result=$db->query($sql);
             $row =$result->fetch();
            echo "<form action=index1.php method=POST>
                    <table class='table table-striped'><tr>
                                <td>請輸入修改的客戶資料:<input type=hidden name='id' value='$id' ><td>
                            </tr>
                            <tr>
                                
                                <td>姓名<input type=text name='name' value=$row[姓名]></td>
                                <td>電話<input type=text name='tel'  value=$row[電話]></td>
                            </tr>
                            <tr>
                                <td>地址<input type=text name='add'  value=$row[地址]></td>
                                <td>車牌號碼<input type=text name='carnum'  value=$row[車牌號碼]></td>
                            </tr>
                            <tr>
                                <td>性別<input type=text name='gender'  value=$row[性別]></td>
                                <td>生日<input type=date name='birth'  value=$row[生日]></td>
                            </tr>
                            <tr>
                                <td></td><td><button type='submit' name='func' value='update_action_customer' class='btn btn-success'>送出</button></td>
                    </table>";
                            
            break;
    //修改商品_車輛    
         case 'update_product_car':
             $id = $_POST['product_id'];
             $sql="SELECT * From 車種 where 車種id='$id'order by 車種id";
             $result=$db->query($sql);
             $row =$result->fetch();
            echo "<form action=index1.php method=POST enctype='multipart/form-data'>
                    <table class='table table-striped'><tr>
                                <td>請輸入修改的車種資料:
                                <input type=hidden name='id' value='$id' ><td>
                            </tr>
                            <tr>
                                <td>型號<input type=text name='type' value=$row[型號]></td>
                                <td>排氣量<input type=text name='cc' value=$row[排氣量]></td>
                            </tr>
                            <tr>
                                <td>庫存<input type=text name='count' value=$row[庫存]></td>
                                <td>單價<input type=text name='price' value=$row[單價]></td>
                            </tr>
                            <tr>
                                <td>成本價<input type=text name='cost' value=$row[成本價]></td>
                                <td>圖片<input type=file name='image'></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type='submit' name='func' value='update_action_product_car' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
            break;
            
            
    //修改商品_零組件        
           case 'update_product_compon':
                $id=$_POST['product_id'];
                 $sql="SELECT * From 零組件 where 零組件id='$id'order by 零組件id";
             $result=$db->query($sql);
             $row =$result->fetch();
             echo "<form action=index1.php method=POST>
                    <table class='table table-striped'><tr>
                                <td>請輸入修改的零組件資料:
                                <input type=hidden name='id' value='$id' ><td>
                            </tr>
                            <tr>
                                <td>料號<input type=text name='type' value=$row[料號]></td>
                                <td>零件名稱<input type=text name='name' value=$row[零件名稱]></td>
                            </tr>
                            <tr>
                                <td>單價<input type=text name='price' value=$row[單價]></td>
                                <td>庫存<input type=text name='count' value=$row[庫存]></td>
                            </tr>
                            <tr>
                                <td>成本價<input type=text name='cost' value=$row[成本價]></td><td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type='submit' name='func' value='update_action_product_compon' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
            break;
            
    //修改商品_保養品        
           case 'update_product_care':
                $id=$_POST['product_id'];
                $sql="SELECT * From 保養品 where 保養品id='$id'order by 保養品id";
                $result=$db->query($sql);
                $row =$result->fetch();
                echo "<form action=index1.php method=POST>
                    <table class='table table-striped'><tr>
                                <td>請輸入修改的保養品資料:
                                <input type=hidden name='id' value='$id' ><td>
                            </tr>
                            <tr>
                                
                                <td>保養品名稱<input type=text name='name' value=$row[保養品名稱]></td>
                            </tr>
                            <tr>
                                <td>單價<input type=text name='price' value=$row[單價]></td>
                                <td>庫存<input type=text name='count' value=$row[庫存]></td>
                            </tr>
                            <tr>
                                <td>成本價<input type=text name='cost' value=$row[成本價]></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type='submit' name='func' value='update_action_product_care' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                break;
                
    //修改員工
         case 'update_employee':
            $id=$_POST['employee_id'];
             $sql="SELECT * From 員工 where 員工id='$id'order by 員工id";
             $result=$db->query($sql);
             $row =$result->fetch();
            echo "<form action=index1.php method=POST>
                    <table class='table table-striped'><tr>
                                <td>請輸入修改的員工資料:<input type=hidden name='id' value=$id><td>
                            </tr>
                            <tr>
                                <td>姓名<input type=text name='name' value=$row[姓名]></td>
                                <td>住址<input type=text name='add' value=$row[住址]></td>
                            </tr>
                            <tr>
                               <td>生日<input type=date name='bir' value=$row[生日]></td>
                               <td>電話<input type=text name='tel' value=$row[電話]></td>
                            </tr>
                            <tr>
                                <td></td><td><button type='submit' name='func' value='update_action_employee' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                            
            break;
            
    //修改員工任職明細
        case 'update_employee_office':
            $employee_office_id=$_POST['employee_office_id'];
            
            echo "<form action=index1.php method=POST>
                    <table class='table table-striped'>";
            echo "<input type=hidden name=employee_office_id value=$employee_office_id>
                            <td>請輸入欲修改的員工任職資料:<td><td></td><td></td>
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
                                <td></td><td><button type='submit' name='func' value='update_action_employee_office' class='btn btn-success'>送出</button></td><td></td><td></td>
                    </table></form>";                            
            
        break;
        
    //修改供應商
         case 'update_supplier':
             $id=$_POST['supplier_id'];
             $sql="SELECT * From 供應商 where 供應商id='$id' order by 供應商id";
             $result=$db->query($sql);
             $row =$result->fetch();
            echo "<form action=index1.php method=POST>
                    <table class='table table-striped'><tr>
                                <td>請輸入修改的供應商資料:<input type=hidden name='id' value='$id'><td>
                            </tr>
                            <tr>
                                <td>供應商名稱<input type=text name='name' value=$row[供應商名稱]></td>
                                <td>地址<input type=text name='add' value=$row[地址]></td>
                            </tr>
                            <tr>
                               
                               <td>電話<input type=text name='tel' value=$row[電話]><td></tds></td>
                            </tr>
                            <tr>
                                <td></td><td><button type='submit' name='func' value='update_action_supplier' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
            break;
    //修改採購明細_車輛
            case 'update_purchase_line_car':
                $id=$_POST['purchase__id'];
                $lid=$_POST['purchase_line_id'];
                $count=$_POST['count'];
             
                echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=purchase__id value=$id>";//傳送單號
                    echo " <input type=hidden name=purchase_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲修改的車輛採購單資料:</td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo '<tr><td>選擇車輛型號 <select name="車種">'; 
                                $sql="select * From 車種 order by 車種id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[車種id]>$row[型號]</option> ";        
                                }
                                echo "</select>";
                                   $sql="SELECT * From 車輛供應明細 where 車輛供應明細id='$lid'order by 車輛供應明細id";
                                   $result=$db->query($sql);
                                   $row =$result->fetch();
                                echo "</td><td>數量<input type=text name=數量 value=$row[數量]></td>
                                <td>出廠日期<input type=date name=出廠日期 value=$row[出廠日期]></td>
                                
                                </tr>";    
                            
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_purchase_line_car' class='btn btn-success'>送出</button><td></td></td>
                            </tr>
                    </table>";
                break;
        
        //修改採購明細_零組件
            case 'update_purchase_line_compon':
                $id=$_POST['purchase__id'];
                $lid=$_POST['purchase_line_id'];
                $count=$_POST['count'];
                
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=purchase__id value=$id>";//傳送單號
                    echo " <input type=hidden name=purchase_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "  <td>請輸入欲修改的零組件採購單資料:</td><td></td>
                            </tr>
                            <tr>";
                    echo '<tr><td>選擇零組件型號 <select name="零件">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                 {
                                   
                                   echo "<option value=$row[零組件id]>$row[零件名稱]</option> ";        
                                }
                                echo "</select>";
                                $sql="SELECT * From 零件供應明細 where 零件供應明細id='$lid'order by 零件供應明細id";
                                $result=$db->query($sql);
                                $row =$result->fetch();
                                echo "</td><td>數量<input type=text name=數量 value=$row[數量]></td></tr>";    
                            
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_purchase_line_compon' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                break;
        
        //修改採購明細_保養品
            case 'update_purchase_line_care':
                $id=$_POST['purchase__id'];
                $lid=$_POST['purchase_line_id'];
                $count=$_POST['count'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=purchase__id value=$id>";//傳送單號
                    echo " <input type=hidden name=purchase_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲修改的保養品採購單資料:<td><td></td>
                            </tr>
                            <tr>";
                    echo '<tr><td>選擇保養品 <select name="保養品">'; 
                                $sql="select * From 保養品 order by 保養品id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                               {
                                   
                                   echo "<option value=$row[保養品id]>$row[保養品名稱]</option> ";        
                                }
                                echo "</select>";
                                   $sql="SELECT * From 保養品供應明細 where 保養品供應明細id='$lid'order by 保養品供應明細id";
                                   $result=$db->query($sql);
                                   $row =$result->fetch();
                                echo "</td><td>數量<input type=text name=數量 value=$row[數量]></td><td>有效日期<input type=date name=有效日期 value=$row[有效日期]></td></tr>";    
                            
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_purchase_line_care' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                break;
        
        
         //修改訂單明細_車輛
            case 'update_order_line_car':
                $id=$_POST['order__id'];
                $lid=$_POST['order_line_id'];
                $count=$_POST['count'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲修改的車輛採購單資料:<td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo '<tr><td>選擇車輛型號 <select name="車種">'; 
                                $sql="select * From 車種 order by 車種id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[車種id]>$row[車種id]  $row[型號]</option> ";        
                                }
                                echo "</select>";
                                   $sql="SELECT * From 車輛訂單明細 where 車輛訂單明細id='$lid'order by 車輛訂單明細id";
                                   $result=$db->query($sql);
                                   $row =$result->fetch();
                                echo "</td><td>車牌號碼<input type=text name=車牌號碼 value=$row[車牌號碼]></td><td>明細備註<input type=textarea name=備註2 value=$row[明細備註]></td><td></td></tr>";    
                                echo "</td><td>交車日期<input type=date name=交車日期 value=$row[交車日期]></td><td>保固日期<input type=date name=保固日期 value=$row[保固日期]></td><td></td><td></td></tr>";
                                echo "</td><td></td><td></td><td></td><td></td></tr>"; 
                            
                                
                            echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_order_line_car' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                break;
        
         //修改訂單明細_零組件
            case 'update_order_line_compon':
                $id=$_POST['order__id'];
                $lid=$_POST['order_line_id'];
                $count=$_POST['count'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲修改的零組件訂單資料:<td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo '<tr><td>選擇零組件 <select name="零組件">'; 
                                $sql="select * From 零組件 order by 零組件id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零組件id]  $row[零件名稱]</option> ";        
                                }
                                echo "</select>";
                                $sql="SELECT * From 零組件訂單明細 where 零組件訂單明細id='$lid'order by 零組件訂單明細id";
                                $result=$db->query($sql);
                                $row =$result->fetch();
                                
                                echo "</td><td>數量<input type=text name=數量 value=$row[數量]></td><td><td></td></td></tr>";   

                    echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_order_line_compon' class='btn btn-success'>送出</button><td></td></td>
                            </tr>
                    </table>";
                break;
        
        //修改訂單明細_保養品
            case 'update_order_line_care':
                $id=$_POST['order__id'];
                $lid=$_POST['order_line_id'];
                $count=$_POST['count'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲修改的保養品訂單資料:<td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo '<tr><td>選擇保養品 <select name="保養品">'; 
                                $sql="select * From 保養品 order by 保養品id";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[保養品id]>$row[保養品id]  $row[保養品名稱]</option> ";        
                                }
                                echo "</select>";
                                $sql="SELECT * From 保養品訂單明細 where 保養品訂單明細id='$lid'order by 保養品訂單明細id";
                                   $result=$db->query($sql);
                                   $row =$result->fetch();
                                echo "</td><td>數量<input type=text name=數量 value=$row[數量]></td><td><td></td></td></tr>";   

                    echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_order_line_care' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                break;
        //修改訂單明細_維修
          case 'update_order_line_repair':
                $id=$_POST['repair__id'];
                $lid=$_POST['order_line_id'];
                $count=$_POST['count'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲修改的維修訂單資料:<td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo '<tr><td>選擇零組件<select name="零組件">'; 
                           $sql="SELECT * FROM 零組件";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零組件id]  $row[零件名稱]</option> ";        
                                }
                                echo "</select>";
                                $sql="SELECT * From 維修明細 where 維修明細id='$lid'order by 維修明細id";
                                $result=$db->query($sql);
                                $row =$result->fetch();
                                echo "</td><td>數量<input type=text name=數量 value=$row[配件數量]></td><td></td><td></td></tr>"; 
                    

                    echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_order_line_repair' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                break;
        
        //修改訂單明細_改裝
          case 'update_order_line_refit':
                $id=$_POST['refit__id'];
                $lid=$_POST['order_line_id'];
                $count=$_POST['count'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo " <input type=hidden name=order_line_id value=$lid>";//傳送明細單號
                    echo " <input type=hidden name=count value=$count>";//傳送總筆數
                    
                    echo "            <td>請輸入欲修改的改裝訂單資料:<td><td></td><td></td>
                            </tr>
                            <tr>";
                    echo '<tr><td>選擇零組件<select name="零組件">'; 
                           $sql="SELECT * FROM 零組件";
                                $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零組件id]  $row[零件名稱]</option> ";        
                                }
                                echo "</select>";
                                $sql="SELECT * From 改裝明細 where 改裝明細id='$lid'order by 改裝明細id";
                                   $result=$db->query($sql);
                                   $row =$result->fetch();
                                echo "</td><td>數量<input type=text name=數量 value=$row[配件數量]></td><td></td><td></td></tr>"; 
                    

                    echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_order_line_refit' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
                break;
        
        
        //修改維修服務金額    
        case 'update_order_repair_money':
            $id=$_POST['repair_id'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                    
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo "            <td>請輸入欲修改的維修金額:<input type=text name=money><td><td></td><td></td></tr>";
                    echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_order_repair_money' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
            break;
        
        
    //修改改裝服務金額    
        case 'update_order_refit_money':
            $id=$_POST['refit_id'];
                    echo "<form action=index1.php method=POST >
                    <table class='table table-striped'><tr>";
                        
                    echo " <input type=hidden name=order__id value=$id>";//傳送單號
                    echo "            <td>請輸入欲修改的改裝金額:<input type=text name=money><td><td></td><td></td></tr>";
                    echo "<tr>
                                <td></td><td><button type='submit' name='func' value='update_action_order_refit_money' class='btn btn-success'>送出</button></td>
                            </tr>
                    </table>";
            break;
        
        
        
    }
?>

