<?php
    session_start();
   
    echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>";
   if (empty($_POST['func'])) {
        $func='show_homepage';   
    }
    
    if (!empty($_POST['func'])) {
        $func=$_POST['func'];    
    }
    
    /*if ($_SESSION['status']!=0 ) {
        $func=$_SESSION['status'];
        $_SESSION['status']=0;
    }*/


    switch ($func) {
        default;
        //首頁.登入登出.註冊
        case 'show_homepage':
            require 'show_homepage.php';
            break;
            
        case 'login_action' :
            require 'login.php';
            break;
            
        case 'logout_action':
            require 'logout.php';
            break;
            
        case 'show_register':
            require 'register.html';
            break;
        
        case 'register_action':
            require 'register_finish.php';
            break;
    
    
            //各項管理
        case 'show_product_manager':
            require 'show_product_manager.php';
            break;
        
        case 'show_purchase_manager':
            require 'show_purchase_manager.php';
            break;
        
        case 'show_order_manager':
            require 'show_order_manager.php';
            break;
        
        case 'show_employee_manager':
            require 'show_employee_manager.php';
            break;
        
        case 'show_customer_manager':
            require 'show_customer_manager.php';
            break;
            
        case 'show_supplier_manager':
            require 'show_supplier_manager.php';
            break;    
            
            
            
            //客戶新增修改刪除查詢
        case 'insert_customer':
            require 'insert.php';
            break;
            
        case 'insert_action_customer':
            require 'insert_action.php';
            break;    
            
        case 'update_customer':
            require 'update.php';
            break;    
            
        case 'update_action_customer':
            require 'update_action.php';
            break;    
            
        case 'delete_action_customer':
            require 'delete_action.php';
            break;    
            
        
        
        //供應商新增修改刪除查詢
        case 'insert_supplier':
            require 'insert.php';
            break;
            
        case 'insert_action_supplier':
            require 'insert_action.php';
            break;    
            
        case 'update_supplier':
            require 'update.php';
            break;    
            
        case 'update_action_supplier':
            require 'update_action.php';
            break;       
            
        case 'delete_action_supplier':
            require 'delete_action.php';
            break;    
            
            
            //員工新增修改刪除查詢
        case 'insert_employee':
            require 'insert.php';
            break;
            
        case 'update_employee':
            require 'update.php';
            break;    
            
        case 'insert_action_employee':
            require 'insert_action.php';
            break;   
            
        case 'insert_employee_office':
            require 'insert.php';
            break;    
        
        case 'insert_action_employee_office':
            require 'insert_action.php';
            break;    
            
        case 'delete_action_employee':
            require 'delete_action.php';
            break;   
        
        case 'delete_action_employee_office':
            require 'delete_action.php';
            break;    
              
        case 'update_action_employee':
            require 'update_action.php';
            break;   
            
        case 'update_employee_office':
            require 'update.php';
            break;    
        
        case 'update_action_employee_office':
            require 'update_action.php';
            break;
            
        case 'look_employee':
            require 'look.php';
            break;    
            
            
            //訂單新增修改刪除查詢
        case 'insert_order_car':
            require 'insert.php';
            break;
            
        case 'insert_order_compon':
            require 'insert.php';
            break;
            
        case 'insert_order_care':
            require 'insert.php';
            break;
            
        case 'insert_order_repair';
            require 'insert.php';
            break;
                    
        case 'insert_action_order_car':
            require 'insert_action.php';
            break;
            
        case 'insert_action_order_compon':
            require 'insert_action.php';
            break;
            
        case 'insert_action_order_care':
            require 'insert_action.php';
            break;  
            
        case 'insert_action_order_repair':
            require 'insert_action.php';
            break;    
            
        case 'insert_order_line_car':
            require 'insert.php'; 
            break; 
            
        case 'insert_order_line_compon':
            require 'insert.php'; 
            break; 
            
        case 'insert_order_line_care':
            require 'insert.php'; 
            break;
            
        case 'insert_order_line_repair':
            require 'insert.php'; 
            break;        
            
        case 'insert_action_order_line_car':
            require 'insert_action.php';
            break;
            
        case 'insert_action_order_line_compon':
            require 'insert_action.php';
            break;
            
        case 'insert_action_order_line_care':
            require 'insert_action.php';
            break;    
            
        case 'insert_action_order_line_repair';
            require 'insert_action.php';
            break;   
            
        case 'insert_order_refit':
            require 'insert.php';
            break;    
            
        case 'insert_action_order_refit':
            require 'insert_action.php';
            break;    
            
        case 'insert_order_line_refit':
            require 'insert.php';
            break;    
            
        case 'insert_action_order_line_refit':
            require 'insert_action.php';
            break;    
            
        case 'update_order_car':
            require 'update.php';
            break;   
            
        case 'update_order_compon':
            require 'update.php';
            break;      
            
        case 'update_order_care':
            require 'update.php';
            break;      
            
        case 'update_order_line_car':
            require 'update.php';
            break;    
            
        case 'update_order_line_compon':
            require 'update.php';
            break;    
            
        case 'update_order_line_care':
            require 'update.php';
            break;
            
        case 'update_order_line_repair':
            require 'update.php';
            break;
            
        case 'update_action_order_line_car':
            require 'update_action.php';
            break; 
            
        case 'update_action_order_line_compon':
            require 'update_action.php';
            break; 
            
        case 'update_action_order_line_care':
            require 'update_action.php';
            break; 
            
        case 'update_action_order_line_repair':
            require 'update_action.php';
            break;
            
        case 'update_order_line_refit':
            require 'update.php';
            break;    
            
        case 'update_action_order_line_refit':
            require 'update_action.php';
            break;        
            
        case 'update_order_refit_money':
            require 'update.php';
            break;    
            
        case 'update_action_order_refit_money':
            require 'update_action.php';
            break;    
            
        case 'update_order_repair_money':
            require 'update.php';
            break;    
            
        case 'update_action_order_repair_money':
            require 'update_action.php';
            break;    
            
        case 'delete_action_order_car':
            require 'delete_action.php';
            break; 
            
        case 'delete_action_order_compon':
            require 'delete_action.php';
            break; 
            
        case 'delete_action_order_care':
            require 'delete_action.php';
            break;     
            
        case 'delete_action_order_line_car':
            require 'delete_action.php';
            break;   
            
        case 'delete_action_order_line_compon':
            require 'delete_action.php';
            break;   
            
        case 'delete_action_order_line_care':
            require 'delete_action.php';
            break;       
            
        case 'delete_action_order_repair':
            require 'delete_action.php';
            break;    
            
        case 'delete_action_order_line_repair':
            require 'delete_action.php';
            break;    
            
        case 'delete_action_order_refit':
            require 'delete_action.php';
            break;    
            
        case 'delete_action_order_line_refit':
            require 'delete_action.php';
            break;    
            
        case 'look_order_car':
            require 'look.php';
            break;
        
        case 'look_order_compon':
            require 'look.php';
            break;
        
        case 'look_order_care':
            require 'look.php';
            break;
            
        case 'look_order_repair';
            require 'look.php';
            break;
            
        case 'look_order_refit':
            require 'look.php';
            break;    
        
        //商品新增修改刪除查詢
        case 'insert_product_car':
            require 'insert.php';
            break;
            
        case 'insert_product_compon':
            require 'insert.php';
            break;    
            
        case 'insert_product_care':
            require 'insert.php';
            break;    
            
         case'insert_action_product_car';
             require 'insert_action.php';
            break;    
            
        case'insert_action_product_compon';
            require'insert_action.php';
            break;
            
        case'insert_action_product_care';
            require'insert_action.php';
            break;
            
        case 'update_product_car':
            require 'update.php';
            break;    
            
        case 'update_product_compon':
            require 'update.php';
            break;        
            
        case 'update_product_care':
            require 'update.php';
            break;    
            
        case 'update_action_product_car':
            require 'update_action.php';
            break;
            
        case 'update_action_product_compon':
            require 'update_action.php';
            break;      
              
        case 'update_action_product_care':
            require 'update_action.php';
            break;
            
        case 'delete_action_product_car':
            require 'delete_action.php';
            break;     
            
        case 'delete_action_product_compon':
            require 'delete_action.php';
            break;
            
        case 'delete_action_product_care':
            require 'delete_action.php';
            break;
        case 'select_product_car';
            require 'select.php';
            break;
            
        case 'select_action_product_car';
            require 'select_action.php';
            break;
            
       case 'select_product_compon';
            require 'select.php';
            break;
       
       case 'select_action_product_compon';
            require 'select_action.php';
            break;
            
        case 'select_product_care';
            require 'select.php';
            break;
        case 'select_action_product_care';
            require 'select_action.php';
            break;
            
            //採購新增修改刪除查詢
        case 'insert_purchase_car':
            require 'insert.php';
            break;
            
        case 'insert_purchase_compon':
            require 'insert.php';
            break;
            
        case 'insert_purchase_care':
            require 'insert.php';
            break;    
            
        case 'insert_purchase_line_car':
            require 'insert.php';
            break;    
            
        case 'insert_purchase_line_compon':
            require 'insert.php';
            break;        
            
        case 'insert_purchase_line_care':
            require 'insert.php';
            break;        
            
        case 'insert_action_purchase_line_car':
            require 'insert_action.php';
            break;    
            
        case 'insert_action_purchase_line_compon':
            require 'insert_action.php';
            break;      
            
        case 'insert_action_purchase_line_care':
            require 'insert_action.php';
            break;      
            
        case 'look_purchase_car':
            require 'look.php';
            break;    
            
        case 'look_purchase_compon':
            require 'look.php';
            break;  
            
        case 'look_purchase_care':
            require 'look.php';
            break;      
            
        case 'update_purchase_line_car':
            require 'update.php';
            break;    
            
        case 'update_purchase_line_compon':
            require 'update.php';
            break;        
            
        case 'update_purchase_line_care':
            require 'update.php';
            break;        
            
        case 'update_action_purchase_line_car':
            require 'update_action.php';
            break;  
            
        case 'update_action_purchase_line_compon':
            require 'update_action.php';
            break;  
            
        case 'update_action_purchase_line_care':
            require 'update_action.php';
            break;      
            
        case 'delete_action_purchase_line_car':
            require 'delete_action.php';
            break;
            
        case 'delete_action_purchase_line_compon':
            require 'delete_action.php';
            break;        
            
        case 'delete_action_purchase_line_care':
            require 'delete_action.php';
            break;            
            
        case 'delete_action_purchase_car':
            require 'delete_action.php';
            break;    
            
        case 'delete_action_purchase_compon':
            require 'delete_action.php';
            break;      
            
        case 'delete_action_purchase_care':
            require 'delete_action.php';
            break;      
     
        case 'insert_action_purchase_car':
            require 'insert_action.php';
            break;       
        
        case 'insert_action_purchase_compon':
            require 'insert_action.php';
            break;         
            
        case 'insert_action_purchase_care':
            require 'insert_action.php';
            break;        
            
        case 'update_action_purchase_car';
            require 'update_action.php';
            break; 
          
    }
   

?>