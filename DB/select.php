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
        case 'select_product_car':
            echo "<form action=index1.php method=POST>
                    <table class='table table-striped'>
                            <tr>
                              <tr><td>選擇車輛型號 <select name='車種'>";
                                 $sql='select * From 車種 order by 車種id';
                                 $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[型號]>$row[型號]</option>";       
                                }
                        echo   "</select>
                              
                            </tr>
                    </table>
                            <tr>
                            <button type='submit' name='func' value='select_action_product_car' class='btn btn-success'>查詢</button>
                            </tr>
                  </form>";
        break;
        
        
        case 'select_product_compon':
            echo "<form action=index1.php method=POST>
                    <table class='table table-striped'>
                            <tr>
                              <tr><td>選擇零組件名稱 <select name='零件名稱'>";
                                 $sql='select * From 零組件 order by 零組件id';
                                 $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[零組件id]>$row[零件名稱]</option>";       
                                }
                        echo   "</select>
                              
                            </tr>
                    </table>
                            <tr>
                            <button type='submit' name='func' value='select_action_product_compon' class='btn btn-success'>查詢</button>
                            </tr>
                  </form>";
        break;
        
        case 'select_product_care':
            echo "<form action=index1.php method=POST>
                    <table class='table table-striped'>
                            <tr>
                              <tr><td>選擇保養品名稱 <select name='保養品名稱'>";
                                 $sql='select * From 保養品 order by 保養品id';
                                 $result=$db->query($sql);
                                foreach($result->fetchAll() as $row)
                                {
                                   
                                   echo "<option value=$row[保養品id]>$row[保養品名稱]</option>";       
                                }
                        echo   "</select>
                              
                            </tr>
                    </table>
                            <tr>
                            <button type='submit' name='func' value='select_action_product_care' class='btn btn-success'>查詢</button>
                            </tr>
                  </form>";
        break;
        
        
            


    }


?>