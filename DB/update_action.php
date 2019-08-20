<?php
require 'mysql.php';
 $db=Database::initDB();
  echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>";
    $fun2=$_POST['func'];
    switch ($fun2) {
        
        //修改客戶
        case 'update_action_customer':
            $name=$_POST['name'];
            $birth=$_POST['birth'];
            $gender=$_POST['gender'];
            $carnum=$_POST['carnum'];
            $tel=$_POST['tel'];
            $add=$_POST['add'];
            $customer_id=$_POST['id'];
            
            $sql = "UPDATE 客戶 SET 車牌號碼='$carnum',姓名='$name',地址='$add',生日='$birth',性別='$gender',電話='$tel' WHERE 客戶id='$customer_id'";
        
            /*$sql = "UPDATE 客戶 SET 車牌號碼=:車牌號碼,姓名=:姓名,地址=:地址,生日=:生日,性別=:性別,電話=:電話 WHERE 客戶id=:客戶id ";
            $result=$db->prepare($sql);
            $result->execute(array(':車牌號碼'=>$carnum,':姓名'=>$name,':地址'=>$add,':生日'=>$birth,':性別'=>$gender,':電話'=>$tel,'客戶id'=>$customer_id));
    */
            $result = $db->exec($sql);
            if ($result > 0) {
                echo "修改成功";
                $_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "修改失敗";
                $_SESSION['status']="update_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
        //修改商品_車輛
        case 'update_action_product_car':
             $type = $_POST['type'];
             $cc = $_POST['cc'];
             $count = $_POST['count'];
             $price = $_POST['price'];
             $cost = $_POST['cost'];
             $car_id=$_POST['id'];
             $image= $_FILES['image'];
             $image_path="../car_image/$image[name]";
            
                     if($image['error']!=UPLOAD_ERR_OK){
                        echo '上傳失敗<br>';
                         
                     }else {
                        echo "上傳成功<br>";
                     }

             
             if(move_uploaded_file($image['tmp_name'],$image_path)){
                            echo "移動檔案成功<br>";
                    
                }else {
                    echo "移動檔案失敗<br>";
                }
             
            $result = $db->exec("UPDATE 車種 SET 型號='$type',排氣量='$cc',庫存='$count',單價='$price',成本價='$cost',車種圖片='$image_path' WHERE 車種id='$car_id'");
      //        $result = $db->prepare("UPDATE 車種 SET 型號='$type',排氣量='$cc',庫存='$count',單價='$price',成本價='$cost' WHERE 車種id='$car_id'");
      //        $result = $result->execute(array(":型號=>$type,:排氣量=>$cc,:庫存=>$count,:單價=>$price,:成本價=>$cost"));
            
            
            if ($result > 0) {
                echo "修改成功";
                $_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "修改失敗";
                $_SESSION['status']="update_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
            
        //修改商品_零組件    
        case 'update_action_product_compon':
             $type = $_POST['type'];
             $name = $_POST['name'];
             $count = $_POST['count'];
             $price = $_POST['price'];
             $cost = $_POST['cost'];
             
             $compon_id=$_POST['id'];
             
            $result = $db->exec("UPDATE 零組件 SET 料號='$type',零件名稱='$name',單價='$price',庫存='$count',成本價='$cost' WHERE 零組件id='$compon_id'");
            
            if ($result > 0) {
                echo "修改成功";
                $_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "修改失敗";
                $_SESSION['status']="update_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
            
        //修改商品_保養品    
         case 'update_action_product_care':
   
             $name = $_POST['name'];
             $count = $_POST['count'];
             $price = $_POST['price'];
             $cost = $_POST['cost'];
             
             $care_id=$_POST['id'];
             
            $result = $db->exec("UPDATE 保養品 SET 保養品名稱='$name',庫存='$count',單價='$price',成本價='$cost' WHERE 保養品id='$care_id'");
            
            if ($result > 0) {
                echo "修改成功";
                $_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "修改失敗";
                $_SESSION['status']="update_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
            
        //修改員工資料    
         case 'update_action_employee':
   
            $name=$_POST['name'];
            $bir=$_POST['bir'];
            $add=$_POST['add'];
            $tel=$_POST['tel'];
          
            $employee_id=$_POST['id'];
            
            $result = $db->exec("UPDATE 員工 SET 姓名='$name',電話='$tel',生日='$bir',住址='$add' WHERE 員工id='$employee_id'");
            
            if ($result > 0) {
                echo "修改成功";
                //$_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "修改失敗";
                //$_SESSION['status']="update_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break; 
            
        //修改員工任職明細
        case 'update_action_employee_office':
            $office=$_POST['office'];
            $date1=$_POST['date1'];
            $date2=$_POST['date2'];
            $employee_office_id=$_POST['employee_office_id'];
            
           
            
            $sql="UPDATE 任職明細 SET 任職起始日='$date1',任職結束日='$date2',職稱id='$office' WHERE 任職明細id='$employee_office_id'";   
            $result=$db->exec($sql);
           if ($result > 0) {
                echo "修改成功";
                //$_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "修改失敗";
                //$_SESSION['status']="update_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
                
            break;
            
            
        //修改供應商資料    
         case 'update_action_supplier':
   
            $name=$_POST['name'];
            $add=$_POST['add'];
            $tel=$_POST['tel'];
          
            $supplier_id=$_POST['id'];
            
            $result = $db->exec("UPDATE 供應商 SET 供應商名稱='$name',電話='$tel',地址='$add' WHERE 供應商id='$supplier_id'");
            
            if ($result > 0) {
                echo "修改成功";
                //$_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "修改失敗";
                //$_SESSION['status']="update_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break; 
            
            
    //修改採購明細_車輛
       case 'update_action_purchase_line_car';
            $數量=$_POST['數量'];
            $出廠日期=$_POST['出廠日期'];
            $車種=$_POST['車種'];
           
            
            $id=$_POST['purchase__id'];//新增才會用到
            $lid=$_POST['purchase_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];//新增才會用到
            
               
                    $sql = "UPDATE 車輛供應明細 SET 數量='$數量',出廠日期='$出廠日期',車種id='$車種' WHERE 車輛供應明細id='$lid'";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
            break;
        
        
        //修改採購明細_零組件
       case 'update_action_purchase_line_compon';
            $數量=$_POST['數量'];
            $零件=$_POST['零件'];
           
            
            $id=$_POST['purchase__id'];//新增才會用到
            $lid=$_POST['purchase_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];//新增才會用到
            
               
                    $sql = "UPDATE 零件供應明細 SET 數量='$數量',零組件id='$零件' WHERE 零件供應明細id='$lid'";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
            break;
        
        
        //修改採購明細_保養品
       case 'update_action_purchase_line_care';
            $數量=$_POST['數量'];
            $有效日期=$_POST['有效日期'];
            $保養品=$_POST['���養品'];
           
            
            $id=$_POST['purchase__id'];//新增才會用到
            $lid=$_POST['purchase_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];//新增才會用到
            
               
                    $sql = "UPDATE 保養品供應明細 SET 數量='$數量',有效日期='$有效日期',保養品id='$保養品' WHERE 保養品供應明細id='$lid'";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
            break;
        
        
        //修改訂單明細_車輛
       case 'update_action_order_line_car';
            $車牌號碼=$_POST['車牌號碼'];
            $備註2=$_POST['備註2'];
            $車種=$_POST['車種'];
            $交車日期=$_POST['交車日期'];
            $保固日期=$_POST['保固日期'];
           
            
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
                    $sql = "UPDATE 車輛訂單明細 SET 交車日期='$交車日期',保固日期='$保固日期',車種id='$車種',車牌號碼='$車牌號碼',備註='$備註2' WHERE 車輛訂單明細id='$lid'";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
            break;
            
            
        //修改訂單明細_零組件
       case 'update_action_order_line_compon';
           
            $零組件=$_POST['零組件'];
            $數量=$_POST['數量'];
           
           
            
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
                    $sql = "UPDATE 零組件訂單明細 SET 零組件id='$零組件',數量='$數量'ㄋ WHERE 零組件訂單明細id='$lid' ";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
            break;    
            
            
         //修改訂單明細_保養品
       case 'update_action_order_line_care';
       
            $保養品=$_POST['保養品'];
            $數量=$_POST['數量'];
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
                    $sql = "UPDATE 保養品訂單明細 SET 保養品id='$保養品',數量='$數量' WHERE 保養品訂單明細id='$lid' ";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
            break;
            
    //修改訂單明細_維修        
        case 'update_action_order_line_repair';
           
            $零組件=$_POST['零組件'];
            $數量=$_POST['數量'];
           
            
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
                    $sql = "UPDATE 維修明細 SET 零組件id='$零組件',配件數量='$數量' WHERE 維修明細id='$lid' ";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                     
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
            break;
            
            
            //修改訂單明細_改裝        
        case 'update_action_order_line_refit';
           
            $零組件=$_POST['零組件'];
            $數量=$_POST['數量'];
           
            
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
                    $sql = "UPDATE 改裝明細 SET 零組件id='$零組件',配件數量='$數量' WHERE 改裝明細id='$lid' ";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
            break;
            
            
        //修改維修訂單金額
        case 'update_action_order_repair_money':
            $id=$_POST['order__id'];
            $money=$_POST['money'];
            
            
            $sql = "UPDATE 維修訂單 SET 維修服務價格='$money' WHERE 維修訂單id='$id' ";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;    
            
        
    //修改改裝訂單金額
        case 'update_action_order_refit_money':
            $id=$_POST['order__id'];
            $money=$_POST['money'];
            
            
            $sql = "UPDATE 改裝訂單 SET 改裝服務價格='$money' WHERE 改裝訂單id='$id' ";
                    $result = $db->exec($sql);
                
                if ($result > 0) {
                    
                    echo "訂單修改成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "修改失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
    }
    ?>