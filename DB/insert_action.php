<?php
    require 'mysql.php';
    $db=Database::initDB();
    $fun2=$_POST['func'];
     echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>";
    switch ($fun2) {
        //新增顧客
        case 'insert_action_customer':
            $name=$_POST['name'];
            $birth=$_POST['birth'];
            $gender=$_POST['gender'];
            $carnum=$_POST['carnum'];
            $tel=$_POST['tel'];
            $add=$_POST['add'];
            
            $sql = "INSERT INTO 客戶(客戶id, 車牌號碼, 姓名, 地址, 生日, 性別, 電話) VALUES(NULL,'$carnum', '$name','$add','$birth','$gender','$tel')";
            $result = $db->exec($sql);
            if ($result > 0) {
                echo "新增成功";
                //$_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
            
            //新增供應商
        case 'insert_action_supplier':
            $name=$_POST['name'];
            $tel=$_POST['tel'];
            $add=$_POST['add'];
            
            $sql = "INSERT INTO 供應商(供應商id,供應商名稱,電話,地址) VALUES(NULL,'$name','$tel','$add')";
            $result = $db->exec($sql);
            if ($result > 0) {
                echo "新增成功";
                //$_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
        
        
    //新增採購_車輛
        case 'insert_action_purchase_car':
            $數量=$_POST['數量'];
            $出廠日期=$_POST['出廠日期'];
            $車種=$_POST['車種'];
            $count=$_POST['count'];
            
            $供應商id=$_POST['供應商id'];
            $交易日期=$_POST['交易日期'];
            
            $sql = "INSERT INTO 車輛進貨單(車輛進貨單id,供應商id,交易日期) VALUES (NULL,'$供應商id','$交易日期')";
            $result = $db->exec($sql);
            if ($result > 0) {
                
            //    echo "訂單新增成功";
                //$_SESSION['status']="show_customer_manager";
                
                $sql="select 車輛進貨單id From 車輛進貨單 order by 車輛進貨單id DESC ";
                $result=$db->query($sql);
                $row=$result->fetch(); 
                $num="$row[車輛進貨單id]";
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 車輛供應明細(車輛供應明細id,數量,出廠日期,車輛進貨單id,車種id) VALUES (NULL,'$數量[$i]','$出廠日期[$i]','$num','$車種[$i]')";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功<br>";
                    //$_SESSION['status']="show_customer_manager";
                     for ($i = 0; $i < $count; $i++) {
                        $sql="SELECT 庫存 FROM 車種 WHERE 車種id=$車種[$i]";
                        $result = $db->query($sql);
                        $num1=$result->fetch();
                        
                        $sum=$num1[庫存]+$數量[$i];
                        
                        $sql="UPDATE 車種 SET 庫存='$sum' WHERE 車種id='$車種[$i]'";
                         $result = $db->exec($sql);
                
                        if ($result > 0) {
                            
                            //echo "庫存修改成功";
                            //$_SESSION['status']="show_customer_manager";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        } else {
                            
                           // echo "庫存修改失敗";
                            //$_SESSION['status']="insert_customer";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        }   
                }
                    
                    
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                }   
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
        //新增採購單_零組件
            case 'insert_action_purchase_compon':
            $數量=$_POST['數量'];
            $零件=$_POST['零件'];
            $count=$_POST['count'];
            
            $供應商id=$_POST['供應商id'];
            $交易日期=$_POST['交易日期'];
            
            $sql = "INSERT INTO 零組件進貨單(零組件進貨單id,交易日期,供應商id) VALUES (NULL,'$交易日期','$供應商id')";
            $result = $db->exec($sql);
            if ($result > 0) {
                
              //  echo "訂單新增成功";
                //$_SESSION['status']="show_customer_manager";
                
                $sql="select 零組件進貨單id From 零組件進貨單 order by 零組件進貨單id DESC ";
                $result=$db->query($sql);
                $row=$result->fetch(); 
                $num="$row[零組件進貨單id]";
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 零件供應明細(零件供應明細id,數量,零組件進貨單id,零組件id) VALUES (NULL,'$數量[$i]','$num','$零件[$i]')";
                    $result = $db->exec($sql) ;
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功<br>";
                    //$_SESSION['status']="show_customer_manager";
                     for ($i = 0; $i < $count; $i++) {
                        $sql="SELECT 庫存 FROM 零組件 WHERE 零組件id=$零件[$i]";
                        $result = $db->query($sql);
                        $num1=$result->fetch();
                        
                        $sum=$num1[庫存]+$數量[$i];
                        
                        $sql="UPDATE 零組件 SET 庫存='$sum' WHERE 零組件id='$零件[$i]'";
                         $result = $db->exec($sql);
                
                        if ($result > 0) {
                            
                            //echo "庫存修改成功";
                            //$_SESSION['status']="show_customer_manager";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        } else {
                            
                           // echo "庫存修改失敗";
                            //$_SESSION['status']="insert_customer";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        }   
                }
                    
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
        //新增採購單_保養品
            case 'insert_action_purchase_care':
            $數量=$_POST['數量'];
            $保養品=$_POST['保養品'];
            $有效日期=$_POST['有效日期'];
            $count=$_POST['count'];
            
            $供應商id=$_POST['供應商id'];
            $交易日期=$_POST['交易日期'];
            
            $sql = "INSERT INTO 保養品進貨單(保養品進貨單id,交易日期,供應商id) VALUES (NULL,'$交易日期','$供應商id')";
            $result = $db->exec($sql);
            if ($result > 0) {
                
        //        echo "訂單新增成功";
                //$_SESSION['status']="show_customer_manager";
                
                $sql="select 保養品進貨單id From 保養品進貨單 order by 保養品進貨單id DESC ";
                $result=$db->query($sql);
                $row=$result->fetch(); 
                $num="$row[保養品進貨單id]";
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 保養品供應明細(保養品供應明細id,有效日期,數量,保養品id,保養品進貨單id) VALUES (NULL,'$有效日期[$i]','$數量[$i]','$保養品[$i]','$num')";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功<br>";
                    //$_SESSION['status']="show_customer_manager";
                     for ($i = 0; $i < $count; $i++) {
                        $sql="SELECT 庫存 FROM 保養品 WHERE 保養品id=$保養品[$i]";
                        $result = $db->query($sql);
                        
                        $num1=$result->fetch();
                        
                        $sum=$num1[庫存]+$數量[$i];
                        
                        $sql="UPDATE 保養品 SET 庫存='$sum' WHERE 保養品id='$保養品[$i]'";
                         $result = $db->exec($sql);
                
                        if ($result > 0) {
                            
                        //    echo "庫存修改成功";
                            //$_SESSION['status']="show_customer_manager";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        } else {
                            
                       //     echo "庫存修改失敗";
                            //$_SESSION['status']="insert_customer";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        }   
                }
                    
                    
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
            
        //新增採購明細_車輛
         case 'insert_action_purchase_line_car':
            $數量=$_POST['數量'];
            $出廠日期=$_POST['出廠日期'];
            $車種=$_POST['車種'];
           
            
            $id=$_POST['purchase__id'];
            $lid=$_POST['purchase_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
               
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 車輛供應明細(車輛供應明細id,數量,出廠日期,車輛進貨單id,車種id) VALUES (NULL,$數量[$i],'$出廠日期[$i]',$id,$車種[$i])";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
        break;
        
        //新增採購明細_零組件
         case 'insert_action_purchase_line_compon':
            $數量=$_POST['數量'];
            $零件=$_POST['零件'];
           
            
            $id=$_POST['purchase__id'];
            $lid=$_POST['purchase_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
               
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 零件供應明細(零件供應明細id,數量,零組件id,零組件進貨單id) VALUES (NULL,$數量[$i],$零件[$i],$id)";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
        break;
        
        
        //新增採購明細_保養品
         case 'insert_action_purchase_line_care':
            $數量=$_POST['數量'];
            $有效日期=$_POST['有效日期'];
            $保養品=$_POST['保養品'];
           
            
            $id=$_POST['purchase__id'];
            $lid=$_POST['purchase_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 保養品供應明細(保養品供應明細id,有效日期,數量,保養品id,保養品進貨單id) VALUES (NULL,'$有效日期[$i]',$數量[$i],$保養品[$i],$id)";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            
        break;
        
        //新增訂單_車輛
        case 'insert_action_order_car':
            
            $交車日期=$_POST['交車日期'];
            $保固���期=$_POST['保固日期'];
            $車種=$_POST['車種'];
            $count=$_POST['count'];
            $車牌號碼=$_POST['車牌號碼'];
            $備註2=$_POST['備註2'];
            
            $交易日期=$_POST['交易日期'];
            $備註1=$_POST['備註1'];
            $員工=$_POST['員工id'];
            $客戶=$_POST['客戶id'];
            
            $sql = "INSERT INTO 車輛訂單(車輛訂單id,交易日期,備註,員工id,客戶id) VALUES (NULL,'$交易日期','$備註1','$員工','$客戶')";
            $result = $db->exec($sql);
            if ($result > 0) {
                
            //    echo "訂單新增成功";
                //$_SESSION['status']="show_customer_manager";
                
                $sql="select 車輛訂單id From 車輛訂單 order by 車輛訂單id DESC ";
                $result=$db->query($sql);
                $row=$result->fetch(); 
                $num="$row[車輛訂單id]";
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 車輛訂單明細(車輛訂單明細id,保固日期,交車日期,車牌號碼,備註,車輛訂單id,車種id) VALUES (NULL,'$保固日期[$i]','$交車日期[$i]','$車牌號碼[$i]','$備註2[$i]','$num','$車種[$i]')";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功<br>";
                    //$_SESSION['status']="show_customer_manager";
                     for ($i = 0; $i < $count; $i++) {
                        $sql="SELECT 庫存 FROM 車種 WHERE 車種id=$車種[$i]";
                        $result = $db->query($sql);
                        $num1=$result->fetch();
                        
                        $sum=$num1[庫存]-1;
                        
                        $sql="UPDATE 車種 SET 庫存='$sum' WHERE 車種id='$車種[$i]'";
                         $result = $db->exec($sql);
                
                        if ($result > 0) {
                            
                     //       echo "庫存修改成功<br>";
                            //$_SESSION['status']="show_customer_manager";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        } else {
                            
                       //     echo "庫存修改失敗";
                            //$_SESSION['status']="insert_customer";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        }   
                }
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
        
            
        //新增車輛
        case 'insert_action_product_car':
            $type = $_POST['type'];
            $cc = $_POST['cc'];
            $count = $_POST['count'];
            $price = $_POST['price'];
            $cost = $_POST['cost'];
            $image= $_FILES['image'];
            $image_path="../car_image/$image[name]";
            
                 if($image['error']!=UPLOAD_ERR_OK){
                        echo '上傳失敗<br>';
                         
                     }else {
                        echo "上傳成功<br>";
                        echo $image['tmp_name'];
                     }
           
                if(move_uploaded_file($image['tmp_name'],$image_path)){
                            echo "移動檔案成功<br>";
                    
                }else {
                    echo "移動檔案失敗<br>";
                }

            $result = $db->exec("INSERT INTO 車種(車種id,型號,排氣量,庫存,單價,成本價,車種圖片) VALUES (NULL,'$type','$cc','$count','$price','$cost','$image_path')");
            
            
             if ($result > 0) {
                echo "新增成功";
                //$_SESSION['status']="show_customer_manager";
               // echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
               // echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            //break;
            
         //新增零件   
          case 'insert_action_product_compon':
            $type = $_POST['type'];
            $name = $_POST['name'];
            $count = $_POST['count'];
            $price = $_POST['price'];
            $cost = $_POST['cost'];  
            
            $result = $db->exec("INSERT INTO 零組件(零組件id,料號,零件名稱,單價,庫存,成本價) VALUES (NULL,'$type','$name','$price','$count','$cost')");
           
                if ($result > 0) {
                    
                    echo "新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            
            break;
            
             
            //新增保養品
            
            case 'insert_action_product_care':
          
            $name = $_POST['name'];
            $count = $_POST['count'];
            $price = $_POST['price'];
            $cost = $_POST['cost'];  
            
            $result = $db->exec("INSERT INTO 保養品(保養品id,保養品名稱,單價,庫存,成本價) VALUES (NULL,'$name',$count,$price,$cost)");
            
             if ($result > 0) {
                echo "新增成功";
                //$_SESSION['status']="show_customer_manager";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
            
    
     //新增員工
         case 'insert_action_employee':
              $name=$_POST['name'];
              $bir=$_POST['bir'];
              $tel=$_POST['tel'];
              $add=$_POST['add'];
              $office=$_POST['office'];
              $date1=$_POST['date1'];
              $date2=$_POST['date2'];
            
            $sql = "INSERT INTO `員工`(`員工id`, `姓名`, `電話`, `生日`, `住址`) VALUES(NULL, '$name','$tel','$bir','$add')";
            $result = $db->exec($sql);
            
            if ($result > 0) {
                echo "新增成功<br>";
                //$_SESSION['status']="show_customer_manager";
                    $sql="SELECT 員工id FROM 員工 ORDER BY 員工id DESC";
                    $result=$db->query($sql);
                    $employee_id=$result->fetch();
                    
                    $sql = "INSERT INTO 任職明細(任職明細id,任職起始日,任職結束日,員工id,職稱id) VALUES(NULL,'$date1','$date2','$employee_id[員工id]','$office')";
                    $result = $db->exec($sql);
                    
                    if ($result > 0) {
                        echo "職位新增成功<br>";
                        //$_SESSION['status']="show_customer_manager";
                        
                        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                    } else {
                        echo "職位新增失敗";
                        //$_SESSION['status']="insert_customer";
                        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                    }   
                    
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
           
        //新增員工任職明細
        case 'insert_action_employee_office':
            $office=$_POST['office'];
            $date1=$_POST['date1'];
            $date2=$_POST['date2'];
            $employee_id=$_POST['employee_id'];
            
            $sql = "INSERT INTO 任職明細(任職明細id,任職起始日,任職結束日,員工id,職稱id) VALUES(NULL,'$date1','$date2','$employee_id','$office')";
            $result = $db->exec($sql);
                    
                    if ($result > 0) {
                        echo "職位新增成功<br>";
                        //$_SESSION['status']="show_customer_manager";
                        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                    } else {
                        echo "職位新增失敗";
                        //$_SESSION['status']="insert_customer";
                        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                    }   
                    
            break;
            
            
        //新增訂單_保養品
        case 'insert_action_order_care':
            $保養品=$_POST['保養品'];
            $count=$_POST['count'];
            $交易日期=$_POST['交易日期'];
            $備註1=$_POST['備註1'];
            $員工=$_POST['員工id'];
            $客戶=$_POST['客戶id'];
            $數量=$_POST['數量'];
            
            $sql = "INSERT INTO 保養品訂單(保養品訂單id,交易日期,客戶id,員工id,備註) VALUES (NULL,'$交易日期','$客戶','$員工','$備註1')";
            $result = $db->exec($sql);
            if ($result > 0) {
                
            //    echo "訂單新增成功";
                //$_SESSION['status']="show_customer_manager";
                
                $sql="SELECT 保養品訂單id FROM 保養品訂單 order by 保養品訂單id DESC ";
                $result=$db->query($sql);
                $row=$result->fetch(); 
                $num="$row[保養品訂單id]";
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 保養品訂單明細(保養品訂單明細id,數量,保養品id,保養品訂單id)  VALUES (NULL,'$數量[$i]','$保養品[$i]','$num')";
                    $result = $db->exec($sql);
                }
                if ($result > 0) {
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                     for ($i = 0; $i < $count; $i++) {
                        $sql="SELECT 庫存 FROM 保養品 WHERE 保養品id=$保養品[$i]";
                        $result = $db->query($sql);
                        $num1=$result->fetch();
                        
                        $sum=$num1[庫存]-$數量[$i];
                        
                        $sql="UPDATE 保養品 SET 庫存='$sum' WHERE 保養品id='$保養品[$i]'";
                         $result = $db->exec($sql);
                
                        if ($result > 0) {
                            
                            //echo "庫存修改成功<br>";
                            //$_SESSION['status']="show_customer_manager";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        } else {
                            
                            //echo "庫存修改失敗";
                            //$_SESSION['status']="insert_customer";
                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                        }   
                }
                    
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=10;url=index1.php>';
                }   
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;    
            
            
    //新增訂單_零組件
        case 'insert_action_order_compon':
            $零組件=$_POST['零組件'];
            $count=$_POST['count'];
            $數量=$_POST['數量'];
            $交易日期=$_POST['交易日期'];
            $備註1=$_POST['備註1'];
            $員工=$_POST['員工id'];
            $客戶=$_POST['客戶id'];
            
            $sql = "INSERT INTO 零組件訂單(零組件訂單id,交易日期,備註,員工id,客戶id) VALUES (NULL,'$交易日期','$備註1','$員工','$客戶')";
            $result = $db->exec($sql);
            if ($result > 0) {
                
            //    echo "訂單新增成功";
                //$_SESSION['status']="show_customer_manager";
                
                $sql="select 零組件訂單id From 零組件訂單 order by 零組件訂單id DESC ";
                $result=$db->query($sql);
                $row=$result->fetch(); 
                $num="$row[零組件訂單id]";
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 零組件訂單明細(零組件訂單明細id,零組件訂單id,零組件id,數量) VALUES (NULL,'$num','$零組件[$i]','$數量[$i]')";
                    $result = $db->exec($sql);
                }
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                
                    echo "明細新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
        //新增訂單明細_車輛
         case 'insert_action_order_line_car':
            $車牌號���=$_POST['車牌號碼'];
            $備註2=$_POST['備註2'];
            $車種=$_POST['車種'];
            $交車日期=$_POST['交車日期'];
            $保固日期=$_POST['保固日期'];
           
            
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//���改與刪除才會用到
            $count=$_POST['count'];
            
               
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 車輛訂單明細(車輛訂單明細id,保固日期,交車日期,車牌號碼,備註,車輛訂單id,車種id) VALUES (NULL,'$保固日期[$i]','$交車日期[$i]','$車牌號碼[$i]','$備註2[$i]','$id','$車種[$i]')";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } 
            break;
            
            
        //新增訂單明細_零組件
         case 'insert_action_order_line_compon':
            
            
            $零組件=$_POST['零組件'];
            $數量=$_POST['數量'];
           
            
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
               
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 零組件訂單明細(零組件訂單明細id,零組件訂單id,零組件id,數量) VALUES (NULL,'$id','$零組件[$i]','$數量[$i]')";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            } 
            break;
        
            
    
         //新增訂單明細_保養品
         case 'insert_action_order_line_care':
            $數量=$_POST['數量'];
           $保養品=$_POST['保養品'];
            $保養品名稱=$_POST['保養品名稱'];
           
           
            
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
            
               
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 保養品訂單明細(保養品訂單明細id,數量,保養品id,保養品訂單id) VALUES (NULL,'$數量[$i]','$保養品[$i]','$id')";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }
            
            break;
    
    
    //新增維修訂單
        case 'insert_action_order_repair':
            $零組件=$_POST['零組件'];
            $count=$_POST['count'];
            $數量=$_POST['數量'];
            $date=$_POST['date'];
            $員工=$_POST['員工id'];
            $客戶=$_POST['客戶id'];
            $price=$_POST['price'];
            $date=$_POST['date'];
            $sql = "INSERT INTO 維修訂單(維修訂單id,維修服務價格,維修日期,員工id,客戶id) VALUES (NULL,'$price','$date','$員工','$客戶')";
            $result = $db->exec($sql);
            if ($result > 0) {
                
            //    echo "訂單新增成功";
                //$_SESSION['status']="show_customer_manager";
                
                $sql="select 維修訂單id From 維修訂單 order by 維修訂單id DESC ";
                $result=$db->query($sql);
                $row=$result->fetch(); 
                $num="$row[維修訂單id]";
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 維修明細(維修明細id,配件數量,維修訂單id,零組件id) VALUES (NULL,'$數量[$i]','$num','$零組件[$i]')";
                    $result = $db->exec($sql);
                }
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                
                    echo "明細新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
            
            //新增改裝訂單
        case 'insert_action_order_refit':
            $零組件=$_POST['零組件'];
            $count=$_POST['count'];
            $數量=$_POST['數量'];
            $date=$_POST['date'];
            $員工=$_POST['員工id'];
            $客戶=$_POST['客戶id'];
            $price=$_POST['price'];
            $date=$_POST['date'];
            $sql = "INSERT INTO 改裝訂單(改裝訂單id,改裝服務價格,改裝日期,員工id,客戶id) VALUES (NULL,'$price','$date','$員工','$客戶')";
            $result = $db->exec($sql);
            if ($result > 0) {
                
            //    echo "訂單新增成功";
                //$_SESSION['status']="show_customer_manager";
                
                $sql="select 改裝訂單id From 改裝訂單 order by 改裝訂單id DESC ";
                $result=$db->query($sql);
                $row=$result->fetch(); 
                $num="$row[改裝訂單id]";
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 改裝明細(改裝明細id,配件數量,改裝訂單id,零組件id) VALUES (NULL,'$數量[$i]','$num','$零組件[$i]')";
                    $result = $db->exec($sql);
                }
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                
                    echo "明細新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            } else {
                echo "新增失敗";
                //$_SESSION['status']="insert_customer";
                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }   
            break;
            
            
        //新增訂單明細_維修
         case 'insert_action_order_line_repair':
            $零件=$_POST['零件'];
            $num=$_POST['數量'];
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
               
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 維修明細(維修明細id,配件數量,維修訂單id,零組件id) VALUES (NULL,'$num[$i]','$id','$零件[$i]')";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }
            
            break;
            
            
            //新增訂單明細_改裝
         case 'insert_action_order_line_refit':
            $零件=$_POST['零件'];
            $num=$_POST['數量'];
            $id=$_POST['order__id'];
            $lid=$_POST['order_line_id'];//修改與刪除才會用到
            $count=$_POST['count'];
               
                for ($i = 0; $i < $count; $i++) {
                    $sql = "INSERT INTO 改裝明細(改裝明細id,配件數量,改裝訂單id,零組件id) VALUES (NULL,'$num[$i]','$id','$零件[$i]')";
                    $result = $db->exec($sql);
                }
                
                if ($result > 0) {
                    
                    echo "訂單新增成功";
                    //$_SESSION['status']="show_customer_manager";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
                } else {
                    
                    echo "新增失敗";
                    //$_SESSION['status']="insert_customer";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';
            }
            
            break;
            
            
            
    }
?>