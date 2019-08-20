<?php  
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
    echo  $_SESSION['name'] . " </font></li> <li role='presentation'><font color='black'>您好         身分:$ident                          </font></li>  " . "    <li role='presentation'><button  name='func' type='submit' value='logout_action' class='btn btn-danger'><span class='glyphicon glyphicon-share' aria-hidden='true'>登出</span></button><br><br></li><li role='presentation'><button  name='func' type='submit' value='show_homepage' class='btn btn-danger'><span class='glyphicon glyphicon-home' aria-hidden='true'>首頁</span></button><br><br></li></ul></nav>";
    echo "<br><br>";
    $fun2=$_POST['func'];
    switch ($fun2) {
        //顧客
        case 'delete_action_customer':
            $id=$_POST['customer_id'];
            $num=$db->exec("DELETE FROM 客戶 WHERE 客戶id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        //供應商
        case 'delete_action_supplier':
            $id=$_POST['supplier_id'];
            $num=$db->exec("DELETE FROM 供應商 WHERE 供應商id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        //員工
        case 'delete_action_employee':
            $id=$_POST['employee_id'];
            $num=$db->exec("DELETE FROM 員工 WHERE 員工id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        
        //員工任職明細
        case 'delete_action_employee_office':
            $employee_office_id=$_POST['employee_office_id'];
            $num=$db->exec("DELETE FROM 任職明細 WHERE 任職明細id='$employee_office_id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
            break;
        
        //採購_車輛
        case 'delete_action_purchase_car':
            $id=$_POST['purchase__id'];
            $num=$db->exec("DELETE FROM 車輛進貨單 WHERE 車輛進貨單id=$id");
                            if($num>0){
                                  echo "執行成功";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }else{
                                  echo "執行失敗";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }
        break;
        //車輛訂單明細
        case 'delete_action_order_line_car':
            $id=$_POST['order_line_id'];
            $num=$db->exec("DELETE FROM 車輛訂單明細 WHERE 車輛訂單明細id=$id");
                            if($num>0){
                                  echo "執行成功";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }else{
                                  echo "執行失敗";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }
        break;
        //零組件訂單明細
        case 'delete_action_order_line_compon':
            $id=$_POST['order_line_id'];
            $num=$db->exec("DELETE FROM 零組件訂單明細 WHERE 零組件訂單明細id=$id");
                            if($num>0){
                                  echo "執行成功";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }else{
                                  echo "執行失敗";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }
        break;
        //保養品訂單明細
        case 'delete_action_order_line_care':
            $id=$_POST['order_line_id'];
            $num=$db->exec("DELETE FROM 保養品訂單明細 WHERE 保養品訂單明細id=$id");
                            if($num>0){
                                  echo "執行成功";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }else{
                                  echo "執行失敗";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }
        break;
        
        
        
        
        
        //採購_零組件
        case 'delete_action_purchase_compon':
            $id=$_POST['purchase__id'];
            $num=$db->exec("DELETE FROM 零組件進貨單 WHERE 零組件進貨單id=$id");
                            if($num>0){
                                  echo "執行成功";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }else{
                                  echo "執行失敗";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }
            
        break;
        //採購_保養品
        case 'delete_action_purchase_care':
            $id=$_POST['purchase__id'];
            
                      $num=$db->exec("DELETE FROM 保養品進貨單 WHERE 保養品進貨單id=$id");
                            if($num>0){
                                  echo "執行成功";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }else{
                                  echo "執行失敗";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }
             
        break;


    //採購明細_車輛
        case 'delete_action_purchase_line_car':
                    $lid=$_POST['purchase_line_id'];//接收明細單號
                    
                    
                    $num=$db->exec("DELETE FROM 車輛供應明細 where 車輛供應明細id=$lid");
                    if($num>0){
                                  echo "執行成功";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }else{
                                  echo "執行失敗";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }
        break;
        
        //採購明細_零件
        case 'delete_action_purchase_line_compon':
                    $lid=$_POST['purchase_line_id'];//接收明細單號
                    
                    
                    $num=$db->exec("DELETE FROM 零件供應明細 where 零件供應明細id=$lid");
                    if($num>0){
                                  echo "執行成功";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }else{
                                  echo "執行失敗";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }
        break;
        
        //採購明細_保養品
        case 'delete_action_purchase_line_care':
                    $lid=$_POST['purchase_line_id'];//接收明細單號
                    
                    
                    $num=$db->exec("DELETE FROM 保養品供應明細 where 保養品供應明細id=$lid");
                    if($num>0){
                                  echo "執行成功";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }else{
                                  echo "執行失敗";
                                  echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                            }
        break;
        
                    
        //車種
        case 'delete_action_product_car':
            $id=$_POST['product_id'];
            $num=$db->exec("DELETE FROM 車種 WHERE 車種id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo $id;
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                      
                }
        break;
        
        //零組件
        case 'delete_action_product_compon':
            $id=$_POST['product_id'];
            $num=$db->exec("DELETE FROM 零組件 WHERE 零組件id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        //保養品
        case 'delete_action_product_care':
            $id=$_POST['product_id'];
            $num=$db->exec("DELETE FROM 保養品 WHERE 保養品id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        //員工
        case 'delete_action_employee':
            $id=$_POST['employee_id'];
            $num=$db->exec("DELETE FROM 員工 WHERE 員工id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        //車輛訂單
        case 'delete_action_order_car':
            $id=$_POST['order_id'];
            $num=$db->exec("DELETE FROM 車輛訂單 WHERE 車輛訂單id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        //零組件訂單
        case 'delete_action_order_compon':
            $id=$_POST['compon_id'];
            $num=$db->exec("DELETE FROM 零組件訂單 WHERE 零組件訂單id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                  
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        //保養品訂單
          case 'delete_action_order_care':
            $id=$_POST['care_id'];
            $num=$db->exec("DELETE FROM 保養品訂單 WHERE 保養品訂單id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        
        //維修訂單
          case 'delete_action_order_repair':
            $id=$_POST['repair_id'];
            $num=$db->exec("DELETE FROM 維修訂單 WHERE 維修訂單id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        
        //改裝訂單
          case 'delete_action_order_refit':
            $id=$_POST['refit_id'];
            $num=$db->exec("DELETE FROM 改裝訂單 WHERE 改裝訂單id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        
         //維修訂單明細
          case 'delete_action_order_line_repair':
            $id=$_POST['order_line_id'];
            $num=$db->exec("DELETE FROM 維修明細 WHERE 維修明細id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        
         //改裝訂單明細
          case 'delete_action_order_line_refit':
            $id=$_POST['order_line_id'];
            $num=$db->exec("DELETE FROM 改裝明細 WHERE 改裝明細id='$id'");
                if($num>0){
                      echo "執行成功";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }else{
                      echo "執行失敗";
                      echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }
        break;
        
        
    }
     echo "</form>";
    echo "</body>";
    echo "</html>";
?>


     