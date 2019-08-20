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
    echo "<form action='index1.php' method=POST align='right'>";
    echo "<nav class='navbar navbar-default' role='navigation'><ul class='nav nav-pills'> <li role='presentation' class='active'><font color='black'>";
    echo  $_SESSION['name'] . " </font></li> <li role='presentation'><font color='black'>您好  身分:" .       $_SESSION['ident'] . "</font></li>  " . "    <li role='presentation'><button  name='func' type='submit' value='logout_action' class='btn btn-danger'><span class='glyphicon glyphicon-share' aria-hidden='true'>登出</span></button><br><br></li><li role='presentation'><button  name='func' type='submit' value='show_homepage' class='btn btn-danger'><span class='glyphicon glyphicon-home' aria-hidden='true'>首頁</span></button><br><br></li></ul></nav>";
    echo "</form><br><br>";
    switch ($fun2) {
        //新增顧客
        case 'select_action_product_car':
            $type = $_POST['車種'];
            echo "<table class='table table-striped'>";
            echo "<tr><td><font color='black'>車種id</font></td><td><font color='black'>型號</font></td><td>排氣量</td><td><font color='black'>庫存</font></td><td><font color='black'>單價</font></td><td><font color='black'>成本價</font></td><td></td></tr>";
            $sql = "SELECT * FROM 車種 WHERE 型號 = '$type'";
            $result = $db->query($sql);
          foreach($result->fetchAll() as $row)
         {
             echo "<tr style='color:black;'><td>$row[車種id]</td><td>$row[型號]</td><td>$row[排氣量]</td><td>$row[庫存]</td><td>$row[單價]</td><td>$row[成本價]</td><td></td></tr>";        
         }
            echo"</table>";
            break;
        case 'select_action_product_compon':
            $type = $_POST['零件名稱'];
            echo "<table class='table table-striped'>";
            echo "<tr><td><font color='black'>零組件id</font></td><td><font color='black'>料號</font></td><td>零件名稱</td><td><font color='black'>單價</font></td><td><font color='black'>庫存</font></td><td><font color='black'>成本價</font></td><td></td></tr>";
            $sql = "SELECT * FROM 零組件 WHERE 零組件id = '$type'";
            $result = $db->query($sql);
          foreach($result->fetchAll() as $row)
         {
             echo "<tr style='color:black;'><td>$row[零組件id]</td><td>$row[料號]</td><td>$row[零件名稱]</td><td>$row[單價]</td><td>$row[庫存]</td><td>$row[成本價]</td><td></td></tr>";        
         }
            echo"</table>";
            break;
            
        case 'select_action_product_care':
            $type = $_POST['保養品名稱'];
            echo "<table class='table table-striped'>";
            echo "<tr><td><font color='black'>保養品id</font></td><td><font color='black'>保養品名稱</font></td><td>庫存</td><td><font color='black'>單價</font></td><td><font color='black'>成本價</font></td></tr>";
            $sql = "SELECT * FROM 保養品 WHERE 保養品id = '$type'";
            $result = $db->query($sql);
          foreach($result->fetchAll() as $row)
         {
             echo "<tr style='color:black;'><td>$row[保養品id]</td><td>$row[保養品名稱]</td><td>$row[庫存]</td><td>$row[單價]</td><td>$row[成本價]</td><td></td></tr>";        
         }
            echo"</table>";
            break;
    }

?>