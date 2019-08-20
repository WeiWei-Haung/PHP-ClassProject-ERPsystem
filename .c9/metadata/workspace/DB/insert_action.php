{"changed":false,"filter":false,"title":"insert_action.php","tooltip":"/DB/insert_action.php","value":"<?php\n    require 'mysql.php';\n    $db=Database::initDB();\n    $fun2=$_POST['func'];\n     echo \"<title>KYMCO 進銷存系統</title>\n                    <meta charset='UTF-8'>\n                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>\n                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>\n                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>\n                     <link rel='icon' href='/DB/123.jpg'>\";\n    switch ($fun2) {\n        //新增顧客\n        case 'insert_action_customer':\n            $name=$_POST['name'];\n            $birth=$_POST['birth'];\n            $gender=$_POST['gender'];\n            $carnum=$_POST['carnum'];\n            $tel=$_POST['tel'];\n            $add=$_POST['add'];\n            \n            $sql = \"INSERT INTO 客戶(客戶id, 車牌號碼, 姓名, 地址, 生日, 性別, 電話) VALUES(NULL,'$carnum', '$name','$add','$birth','$gender','$tel')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                echo \"新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n            \n            //新增供應商\n        case 'insert_action_supplier':\n            $name=$_POST['name'];\n            $tel=$_POST['tel'];\n            $add=$_POST['add'];\n            \n            $sql = \"INSERT INTO 供應商(供應商id,供應商名稱,電話,地址) VALUES(NULL,'$name','$tel','$add')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                echo \"新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n        \n        \n    //新增採購_車輛\n        case 'insert_action_purchase_car':\n            $數量=$_POST['數量'];\n            $出廠日期=$_POST['出廠日期'];\n            $車種=$_POST['車種'];\n            $count=$_POST['count'];\n            \n            $供應商id=$_POST['供應商id'];\n            $交易日期=$_POST['交易日期'];\n            \n            $sql = \"INSERT INTO 車輛進貨單(車輛進貨單id,供應商id,交易日期) VALUES (NULL,'$供應商id','$交易日期')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                \n            //    echo \"訂單新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                \n                $sql=\"select 車輛進貨單id From 車輛進貨單 order by 車輛進貨單id DESC \";\n                $result=$db->query($sql);\n                $row=$result->fetch(); \n                $num=\"$row[車輛進貨單id]\";\n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 車輛供應明細(車輛供應明細id,數量,出廠日期,車輛進貨單id,車種id) VALUES (NULL,'$數量[$i]','$出廠日期[$i]','$num','$車種[$i]')\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功<br>\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                     for ($i = 0; $i < $count; $i++) {\n                        $sql=\"SELECT 庫存 FROM 車種 WHERE 車種id=$車種[$i]\";\n                        $result = $db->query($sql);\n                        $num1=$result->fetch();\n                        \n                        $sum=$num1[庫存]+$數量[$i];\n                        \n                        $sql=\"UPDATE 車種 SET 庫存='$sum' WHERE 車種id='$車種[$i]'\";\n                         $result = $db->exec($sql);\n                \n                        if ($result > 0) {\n                            \n                            //echo \"庫存修改成功\";\n                            //$_SESSION['status']=\"show_customer_manager\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        } else {\n                            \n                           // echo \"庫存修改失敗\";\n                            //$_SESSION['status']=\"insert_customer\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        }   \n                }\n                    \n                    \n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                }   \n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n        //新增採購單_零組件\n            case 'insert_action_purchase_compon':\n            $數量=$_POST['數量'];\n            $零件=$_POST['零件'];\n            $count=$_POST['count'];\n            \n            $供應商id=$_POST['供應商id'];\n            $交易日期=$_POST['交易日期'];\n            \n            $sql = \"INSERT INTO 零組件進貨單(零組件進貨單id,交易日期,供應商id) VALUES (NULL,'$交易日期','$供應商id')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                \n              //  echo \"訂單新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                \n                $sql=\"select 零組件進貨單id From 零組件進貨單 order by 零組件進貨單id DESC \";\n                $result=$db->query($sql);\n                $row=$result->fetch(); \n                $num=\"$row[零組件進貨單id]\";\n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 零件供應明細(零件供應明細id,數量,零組件進貨單id,零組件id) VALUES (NULL,'$數量[$i]','$num','$零件[$i]')\";\n                    $result = $db->exec($sql) ;\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功<br>\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                     for ($i = 0; $i < $count; $i++) {\n                        $sql=\"SELECT 庫存 FROM 零組件 WHERE 零組件id=$零件[$i]\";\n                        $result = $db->query($sql);\n                        $num1=$result->fetch();\n                        \n                        $sum=$num1[庫存]+$數量[$i];\n                        \n                        $sql=\"UPDATE 零組件 SET 庫存='$sum' WHERE 零組件id='$零件[$i]'\";\n                         $result = $db->exec($sql);\n                \n                        if ($result > 0) {\n                            \n                            //echo \"庫存修改成功\";\n                            //$_SESSION['status']=\"show_customer_manager\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        } else {\n                            \n                           // echo \"庫存修改失敗\";\n                            //$_SESSION['status']=\"insert_customer\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        }   \n                }\n                    \n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n        //新增採購單_保養品\n            case 'insert_action_purchase_care':\n            $數量=$_POST['數量'];\n            $保養品=$_POST['保養品'];\n            $有效日期=$_POST['有效日期'];\n            $count=$_POST['count'];\n            \n            $供應商id=$_POST['供應商id'];\n            $交易日期=$_POST['交易日期'];\n            \n            $sql = \"INSERT INTO 保養品進貨單(保養品進貨單id,交易日期,供應商id) VALUES (NULL,'$交易日期','$供應商id')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                \n        //        echo \"訂單新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                \n                $sql=\"select 保養品進貨單id From 保養品進貨單 order by 保養品進貨單id DESC \";\n                $result=$db->query($sql);\n                $row=$result->fetch(); \n                $num=\"$row[保養品進貨單id]\";\n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 保養品供應明細(保養品供應明細id,有效日期,數量,保養品id,保養品進貨單id) VALUES (NULL,'$有效日期[$i]','$數量[$i]','$保養品[$i]','$num')\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功<br>\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                     for ($i = 0; $i < $count; $i++) {\n                        $sql=\"SELECT 庫存 FROM 保養品 WHERE 保養品id=$保養品[$i]\";\n                        $result = $db->query($sql);\n                        \n                        $num1=$result->fetch();\n                        \n                        $sum=$num1[庫存]+$數量[$i];\n                        \n                        $sql=\"UPDATE 保養品 SET 庫存='$sum' WHERE 保養品id='$保養品[$i]'\";\n                         $result = $db->exec($sql);\n                \n                        if ($result > 0) {\n                            \n                        //    echo \"庫存修改成功\";\n                            //$_SESSION['status']=\"show_customer_manager\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        } else {\n                            \n                       //     echo \"庫存修改失敗\";\n                            //$_SESSION['status']=\"insert_customer\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        }   \n                }\n                    \n                    \n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n            \n        //新增採購明細_車輛\n         case 'insert_action_purchase_line_car':\n            $數量=$_POST['數量'];\n            $出廠日期=$_POST['出廠日期'];\n            $車種=$_POST['車種'];\n           \n            \n            $id=$_POST['purchase__id'];\n            $lid=$_POST['purchase_line_id'];//修改與刪除才會用到\n            $count=$_POST['count'];\n            \n               \n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 車輛供應明細(車輛供應明細id,數量,出廠日期,車輛進貨單id,車種id) VALUES (NULL,$數量[$i],'$出廠日期[$i]',$id,$車種[$i])\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                    \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            \n            \n        break;\n        \n        //新增採購明細_零組件\n         case 'insert_action_purchase_line_compon':\n            $數量=$_POST['數量'];\n            $零件=$_POST['零件'];\n           \n            \n            $id=$_POST['purchase__id'];\n            $lid=$_POST['purchase_line_id'];//修改與刪除才會用到\n            $count=$_POST['count'];\n            \n               \n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 零件供應明細(零件供應明細id,數量,零組件id,零組件進貨單id) VALUES (NULL,$數量[$i],$零件[$i],$id)\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                    \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            \n            \n        break;\n        \n        \n        //新增採購明細_保養品\n         case 'insert_action_purchase_line_care':\n            $數量=$_POST['數量'];\n            $有效日期=$_POST['有效日期'];\n            $保養品=$_POST['保養品'];\n           \n            \n            $id=$_POST['purchase__id'];\n            $lid=$_POST['purchase_line_id'];//修改與刪除才會用到\n            $count=$_POST['count'];\n            \n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 保養品供應明細(保養品供應明細id,有效日期,數量,保養品id,保養品進貨單id) VALUES (NULL,'$有效日期[$i]',$數量[$i],$保養品[$i],$id)\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                    \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            \n            \n        break;\n        \n        //新增訂單_車輛\n        case 'insert_action_order_car':\n            \n            $交車日期=$_POST['交車日���'];\n            $保固���期=$_POST['保固日期'];\n            $車種=$_POST['車種'];\n            $count=$_POST['count'];\n            $車牌號碼=$_POST['車牌號碼'];\n            $備註2=$_POST['備註2'];\n            \n            $交易日期=$_POST['交易日期'];\n            $備註1=$_POST['備註1'];\n            $員工=$_POST['員工id'];\n            $客戶=$_POST['客戶id'];\n            \n            $sql = \"INSERT INTO 車輛訂單(車輛訂單id,交易日期,備註,員工id,客戶id) VALUES (NULL,'$交易日期','$備註1','$員工','$客戶')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                \n            //    echo \"訂單新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                \n                $sql=\"select 車輛訂單id From 車輛訂單 order by 車輛訂單id DESC \";\n                $result=$db->query($sql);\n                $row=$result->fetch(); \n                $num=\"$row[車輛訂單id]\";\n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 車輛訂單明細(車輛訂單明細id,保固日期,交車日期,車牌號碼,備註,車輛訂單id,車種id) VALUES (NULL,'$保固日期[$i]','$交車日期[$i]','$車牌號碼[$i]','$備註2[$i]','$num','$車種[$i]')\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功<br>\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                     for ($i = 0; $i < $count; $i++) {\n                        $sql=\"SELECT 庫存 FROM 車種 WHERE 車種id=$車種[$i]\";\n                        $result = $db->query($sql);\n                        $num1=$result->fetch();\n                        \n                        $sum=$num1[庫存]-1;\n                        \n                        $sql=\"UPDATE 車種 SET 庫存='$sum' WHERE 車種id='$車種[$i]'\";\n                         $result = $db->exec($sql);\n                \n                        if ($result > 0) {\n                            \n                     //       echo \"庫存修改成功<br>\";\n                            //$_SESSION['status']=\"show_customer_manager\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        } else {\n                            \n                       //     echo \"庫存修改失敗\";\n                            //$_SESSION['status']=\"insert_customer\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        }   \n                }\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n        \n            \n        //新增車輛\n        case 'insert_action_product_car':\n            $type = $_POST['type'];\n            $cc = $_POST['cc'];\n            $count = $_POST['count'];\n            $price = $_POST['price'];\n            $cost = $_POST['cost'];\n            $image= $_FILES['image'];\n            $image_path=\"../car_image/$image[name]\";\n            \n                 if($image['error']!=UPLOAD_ERR_OK){\n                        echo '上傳失敗<br>';\n                         \n                     }else {\n                        echo \"上傳成功<br>\";\n                        echo $image['tmp_name'];\n                     }\n           \n                if(move_uploaded_file($image['tmp_name'],$image_path)){\n                            echo \"移動檔案成功<br>\";\n                    \n                }else {\n                    echo \"移動檔案失敗<br>\";\n                }\n\n            $result = $db->exec(\"INSERT INTO 車種(車種id,型號,排氣量,庫存,單價,成本價,車種圖片) VALUES (NULL,'$type','$cc','$count','$price','$cost','$image_path')\");\n            \n            \n             if ($result > 0) {\n                echo \"新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n               // echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n               // echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            //break;\n            \n         //新增零件   \n          case 'insert_action_product_compon':\n            $type = $_POST['type'];\n            $name = $_POST['name'];\n            $count = $_POST['count'];\n            $price = $_POST['price'];\n            $cost = $_POST['cost'];  \n            \n            $result = $db->exec(\"INSERT INTO 零組件(零組件id,料號,零件名稱,單價,庫存,成本價) VALUES (NULL,'$type','$name','$price','$count','$cost')\");\n           \n                if ($result > 0) {\n                    \n                    echo \"新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            \n            break;\n            \n             \n            //新增保養品\n            \n            case 'insert_action_product_care':\n          \n            $name = $_POST['name'];\n            $count = $_POST['count'];\n            $price = $_POST['price'];\n            $cost = $_POST['cost'];  \n            \n            $result = $db->exec(\"INSERT INTO 保養品(保養品id,保養品名稱,單價,庫存,成本價) VALUES (NULL,'$name',$count,$price,$cost)\");\n            \n             if ($result > 0) {\n                echo \"新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n            \n    \n     //新增員工\n         case 'insert_action_employee':\n              $name=$_POST['name'];\n              $bir=$_POST['bir'];\n              $tel=$_POST['tel'];\n              $add=$_POST['add'];\n              $office=$_POST['office'];\n              $date1=$_POST['date1'];\n              $date2=$_POST['date2'];\n            \n            $sql = \"INSERT INTO `員工`(`員工id`, `姓名`, `電話`, `生日`, `住址`) VALUES(NULL, '$name','$tel','$bir','$add')\";\n            $result = $db->exec($sql);\n            \n            if ($result > 0) {\n                echo \"新增成功<br>\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                    $sql=\"SELECT 員工id FROM 員工 ORDER BY 員工id DESC\";\n                    $result=$db->query($sql);\n                    $employee_id=$result->fetch();\n                    \n                    $sql = \"INSERT INTO 任職明細(任職明細id,任職起始日,任職結束日,員工id,職稱id) VALUES(NULL,'$date1','$date2','$employee_id[員工id]','$office')\";\n                    $result = $db->exec($sql);\n                    \n                    if ($result > 0) {\n                        echo \"職位新增成功<br>\";\n                        //$_SESSION['status']=\"show_customer_manager\";\n                        \n                        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                    } else {\n                        echo \"職位新增失敗\";\n                        //$_SESSION['status']=\"insert_customer\";\n                        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                    }   \n                    \n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n           \n        //新增員工任職明細\n        case 'insert_action_employee_office':\n            $office=$_POST['office'];\n            $date1=$_POST['date1'];\n            $date2=$_POST['date2'];\n            $employee_id=$_POST['employee_id'];\n            \n            $sql = \"INSERT INTO 任職明細(任職明細id,任職起始日,任職結束日,員工id,職稱id) VALUES(NULL,'$date1','$date2','$employee_id','$office')\";\n            $result = $db->exec($sql);\n                    \n                    if ($result > 0) {\n                        echo \"職位新增成功<br>\";\n                        //$_SESSION['status']=\"show_customer_manager\";\n                        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                    } else {\n                        echo \"職位新增失敗\";\n                        //$_SESSION['status']=\"insert_customer\";\n                        echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                    }   \n                    \n            break;\n            \n            \n        //新增訂單_保養品\n        case 'insert_action_order_care':\n            $保養品=$_POST['保養品'];\n            $count=$_POST['count'];\n            $交易日期=$_POST['交易日期'];\n            $備註1=$_POST['備註1'];\n            $員工=$_POST['員工id'];\n            $客戶=$_POST['客戶id'];\n            $數量=$_POST['數量'];\n            \n            $sql = \"INSERT INTO 保養品訂單(保養品訂單id,交易日期,客戶id,員工id,備註) VALUES (NULL,'$交易日期','$客戶','$員工','$備註1')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                \n            //    echo \"訂單新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                \n                $sql=\"SELECT 保養品訂單id FROM 保養品訂單 order by 保養品訂單id DESC \";\n                $result=$db->query($sql);\n                $row=$result->fetch(); \n                $num=\"$row[保養品訂單id]\";\n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 保養品訂單明細(保養品訂單明細id,數量,保養品id,保養品訂單id)  VALUES (NULL,'$數量[$i]','$保養品[$i]','$num')\";\n                    $result = $db->exec($sql);\n                }\n                if ($result > 0) {\n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                     for ($i = 0; $i < $count; $i++) {\n                        $sql=\"SELECT 庫存 FROM 保養品 WHERE 保養品id=$保養品[$i]\";\n                        $result = $db->query($sql);\n                        $num1=$result->fetch();\n                        \n                        $sum=$num1[庫存]-$數量[$i];\n                        \n                        $sql=\"UPDATE 保養品 SET 庫存='$sum' WHERE 保養品id='$保養品[$i]'\";\n                         $result = $db->exec($sql);\n                \n                        if ($result > 0) {\n                            \n                            //echo \"庫存修改成功<br>\";\n                            //$_SESSION['status']=\"show_customer_manager\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        } else {\n                            \n                            //echo \"庫存修改失敗\";\n                            //$_SESSION['status']=\"insert_customer\";\n                            echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                        }   \n                }\n                    \n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                    \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=10;url=index1.php>';\n                }   \n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;    \n            \n            \n    //新增訂單_零組件\n        case 'insert_action_order_compon':\n            $零組件=$_POST['零組件'];\n            $count=$_POST['count'];\n            $數量=$_POST['數量'];\n            $交易日期=$_POST['交易日期'];\n            $備註1=$_POST['備註1'];\n            $員工=$_POST['員工id'];\n            $客戶=$_POST['客戶id'];\n            \n            $sql = \"INSERT INTO 零組件訂單(零組件訂單id,交易日期,備註,員工id,客戶id) VALUES (NULL,'$交易日期','$備註1','$員工','$客戶')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                \n            //    echo \"訂單新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                \n                $sql=\"select 零組件訂單id From 零組件訂單 order by 零組件訂單id DESC \";\n                $result=$db->query($sql);\n                $row=$result->fetch(); \n                $num=\"$row[零組件訂單id]\";\n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 零組件訂單明細(零組件訂單明細id,零組件訂單id,零組件id,數量) VALUES (NULL,'$num','$零組件[$i]','$數量[$i]')\";\n                    $result = $db->exec($sql);\n                }\n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                \n                    echo \"明細新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n        //新增訂單明細_車輛\n         case 'insert_action_order_line_car':\n            $車牌號���=$_POST['車牌號碼'];\n            $備註2=$_POST['備註2'];\n            $車種=$_POST['車種'];\n            $交車日期=$_POST['交車日期'];\n            $保固日期=$_POST['保固日期'];\n           \n            \n            $id=$_POST['order__id'];\n            $lid=$_POST['order_line_id'];//���改與刪除才會用到\n            $count=$_POST['count'];\n            \n               \n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 車輛訂單明細(車輛訂單明細id,保固日期,交車日期,車牌號碼,備註,車輛訂單id,車種id) VALUES (NULL,'$保固日期[$i]','$交車日期[$i]','$車牌號碼[$i]','$備註2[$i]','$id','$車種[$i]')\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                    \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            } \n            break;\n            \n            \n        //新增訂單明細_零組件\n         case 'insert_action_order_line_compon':\n            \n            \n            $零組件=$_POST['零組件'];\n            $數量=$_POST['數量'];\n           \n            \n            $id=$_POST['order__id'];\n            $lid=$_POST['order_line_id'];//修改與刪除才會用到\n            $count=$_POST['count'];\n            \n               \n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 零組件訂單明細(零組件訂單明細id,零組件訂單id,零組件id,數量) VALUES (NULL,'$id','$零組件[$i]','$數量[$i]')\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                    \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            } \n            break;\n        \n            \n    \n         //新增訂單明細_保養品\n         case 'insert_action_order_line_care':\n            $數量=$_POST['數量'];\n           $保養品=$_POST['保養品'];\n            $保養品名稱=$_POST['保養品名稱'];\n           \n           \n            \n            $id=$_POST['order__id'];\n            $lid=$_POST['order_line_id'];//修改與刪除才會用到\n            $count=$_POST['count'];\n            \n               \n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 保養品訂單明細(保養品訂單明細id,數量,保養品id,保養品訂單id) VALUES (NULL,'$數量[$i]','$保養品[$i]','$id')\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                    \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }\n            \n            break;\n    \n    \n    //新增維修訂單\n        case 'insert_action_order_repair':\n            $零組件=$_POST['零組件'];\n            $count=$_POST['count'];\n            $數量=$_POST['數量'];\n            $date=$_POST['date'];\n            $員工=$_POST['員工id'];\n            $客戶=$_POST['客戶id'];\n            $price=$_POST['price'];\n            $date=$_POST['date'];\n            $sql = \"INSERT INTO 維修訂單(維修訂單id,維修服務價格,維修日期,員工id,客戶id) VALUES (NULL,'$price','$date','$員工','$客戶')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                \n            //    echo \"訂單新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                \n                $sql=\"select 維修訂單id From 維修訂單 order by 維修訂單id DESC \";\n                $result=$db->query($sql);\n                $row=$result->fetch(); \n                $num=\"$row[維修訂單id]\";\n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 維修明細(維修明細id,配件數量,維修訂單id,零組件id) VALUES (NULL,'$數量[$i]','$num','$零組件[$i]')\";\n                    $result = $db->exec($sql);\n                }\n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                \n                    echo \"明細新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n            \n            //新增改裝訂單\n        case 'insert_action_order_refit':\n            $零組件=$_POST['零組件'];\n            $count=$_POST['count'];\n            $數量=$_POST['數量'];\n            $date=$_POST['date'];\n            $員工=$_POST['員工id'];\n            $客戶=$_POST['客戶id'];\n            $price=$_POST['price'];\n            $date=$_POST['date'];\n            $sql = \"INSERT INTO 改裝訂單(改裝訂單id,改裝服務價格,改裝日期,員工id,客戶id) VALUES (NULL,'$price','$date','$員工','$客戶')\";\n            $result = $db->exec($sql);\n            if ($result > 0) {\n                \n            //    echo \"訂單新增成功\";\n                //$_SESSION['status']=\"show_customer_manager\";\n                \n                $sql=\"select 改裝訂單id From 改裝訂單 order by 改裝訂單id DESC \";\n                $result=$db->query($sql);\n                $row=$result->fetch(); \n                $num=\"$row[改裝訂單id]\";\n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 改裝明細(改裝明細id,配件數量,改裝訂單id,零組件id) VALUES (NULL,'$數量[$i]','$num','$零組件[$i]')\";\n                    $result = $db->exec($sql);\n                }\n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                \n                    echo \"明細新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            } else {\n                echo \"新增失敗\";\n                //$_SESSION['status']=\"insert_customer\";\n                echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }   \n            break;\n            \n            \n        //新增訂單明細_維修\n         case 'insert_action_order_line_repair':\n            $零件=$_POST['零件'];\n            $num=$_POST['數量'];\n            $id=$_POST['order__id'];\n            $lid=$_POST['order_line_id'];//修改與刪除才會用到\n            $count=$_POST['count'];\n               \n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 維修明細(維修明細id,配件數量,維修訂單id,零組件id) VALUES (NULL,'$num[$i]','$id','$零件[$i]')\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                    \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }\n            \n            break;\n            \n            \n            //新增訂單明細_改裝\n         case 'insert_action_order_line_refit':\n            $零件=$_POST['零件'];\n            $num=$_POST['數量'];\n            $id=$_POST['order__id'];\n            $lid=$_POST['order_line_id'];//修改與刪除才會用到\n            $count=$_POST['count'];\n               \n                for ($i = 0; $i < $count; $i++) {\n                    $sql = \"INSERT INTO 改裝明細(改裝明細id,配件數量,改裝訂單id,零組件id) VALUES (NULL,'$num[$i]','$id','$零件[$i]')\";\n                    $result = $db->exec($sql);\n                }\n                \n                if ($result > 0) {\n                    \n                    echo \"訂單新增成功\";\n                    //$_SESSION['status']=\"show_customer_manager\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n                } else {\n                    \n                    echo \"新增失敗\";\n                    //$_SESSION['status']=\"insert_customer\";\n                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';\n            }\n            \n            break;\n            \n            \n            \n    }\n?>","undoManager":{"mark":-1,"position":-1,"stack":[]},"ace":{"folds":[],"scrolltop":7457,"scrollleft":0,"selection":{"start":{"row":551,"column":56},"end":{"row":551,"column":56},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":531,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1523472096062}