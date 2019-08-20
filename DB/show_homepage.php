
<?php
session_start();
if (empty($_SESSION['name'])) {
    
    echo "  

            <html lang= 'zh-Hant'>
            
                <head>
                
               
                    <title>KYMCO </title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>
                    <style> 
                     
                    
                    
                     
                    
%sent-hover{
  cursor: pointer;
  @include trans-time(1s);
}
* {
    outline: none;
}   
html,
body {
    height: 100%;
    margin: 0;
}
    
body {
    background:black;
    color: white;
    font-family: monospace;
}
    
.form-container {
    margin: 30px 0;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
    
.input-container {
    position: relative;
    margin-top: 2em;
    width: 250px;
}
input,
textarea {
    position: relative;
    width: 100%;
    padding: 6px 0;
    line-height: 160%;
    font-size: 14px;
    background: none;
    color: white;
    border: none;
    border-bottom: 1px solid #aaa;
    }

label {
    position: absolute;
    left: 0;
    top: 0;
    font-size: 14px;
    line-height: 14px;
    padding: 6px 0;
    text-transform: uppercase;
    @include trans-time(0.5s);
}

input:focus+label,
input:valid+label,
textarea:focus+label,
textarea:valid+label {
    transform: translateX(-4.5em);
    opacity: 0.5;
}

input[value]:invalid+label,
textarea[value]:invalid+label{
  color:red;
  transform: translateX(-4.5em);
  opacity:0.5;
}

.sent-wrap{
    @extend %sent-hover;
    #sent{
        @extend %sent-hover;
        z-index: 2;
    }
    &:after{
        content: 'CLICK!';
        line-height: 34px;
        position: absolute;
        text-align: center;
        color: black;
        opacity: 0;
        top: 0;
        left: 0;
        height: 100%;
        background: white;
        @include trans-time(0.5s);
        width: 100%;
    
    }
    &:hover{
        #sent{
           opacity: 0;
        }
        &:after{
           opacity: 1;
        }
      }
}
</style>
<script>
$('input, textarea').on('input',function(){
  this.setAttribute('value', this.value);
});
</script>

                </head>
                <body>
                    
                    <form  action='index1.php'  method='post' >
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        <table align='center' >
                        <tr><td><font color='white' size='8'>KYMCO機車進銷存系統</td></tr>
                            <tr><td><div class='input-container'>  <input type='text' name='userid' required/><label for='name'>userid</label>
  </div></td></tr>
                            <tr><td><div class='input-container'> <input type='password' name='userpwd' required/><label for='name'>password</label>
 </div></td></tr>
                            <tr><td><div id='sent-container' class='input-container sent-wrap'><button type='submit'  class='btn btn-success' name='func' value='login_action'><span class='glyphicon glyphicon-home' aria-hidden='true'>登入</span></button></div></td></tr>
                            <tr><td> <button class='btn btn-danger' type='reset'><span class='glyphicon glyphicon-trash' aria-hidden='true'>清除</span></button></td></tr>
                            
                            <tr><td><fb:login-button scope='public_profile,email' onlogin='checkLoginState();'></fb:login-button></td></tr>
                            </table>
                    </form>
                    <form align='center' action='register.html' method='POST'>
                    <table align='center' >
                    <tr><td><button name='func' value='show_register' class='btn btn-primary' type='submit'><span class='glyphicon glyphicon-plus' aria-hidden='true'>申請帳號</span></button></td></tr>                    
                    </table> 
                    </form>
                    <script>
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                testAPI();
               
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                //document.getElementById('status').innerHTML = 'Please log ' +
                  //      'into this app.';
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                document.getElementById('status').innerHTML = 'Please log ' +
                        'into Facebook.';
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: '266112077073533',
                cookie: true, // enable cookies to allow the server to access 
                // the session
                xfbml: true, // parse social plugins on this page
                version: 'v2.6' // use version 2.2
            });
            FB.Event.subscribe('auth.login',function(response){
location.href='http://fs.mis.kuas.edu.tw/~s1103137241/index1.php';            
});

            // Now that we've initialized the JavaScript SDK, we call 
            // FB.getLoginStatus().  This function gets the state of the
            // person visiting this page and can return one of three states to
            // the callback you provide.  They can be:
            //
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.
            //
            // These three cases are handled in the callback function.

            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });

        };

        // Load the SDK asynchronously
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = '//connect.facebook.net/en_US/sdk.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function (response) {
                console.log('Successful login for: ' + response.name);
                document.getElementById('status').innerHTML =
                        'Thanks for logging in, ' + response.name + '!';
                        
    $type=2;
                       
            });
        }
    </script>



                </body>
            </html>";
} else {
    
    switch ($_SESSION['type'])
    {
        default;
        case '1':
            $_SESSION['ident']="管理員";
            break;        
            
        case '2':
           $_SESSION['ident']="員工";
            break;    
            
    } echo "  

            <html lang= 'zh-Hant'>
            
                <head>
                
               
                    <title>KYMCO </title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>
                    <style> 
                     
                    
                    
                     
                    
%sent-hover{
  cursor: pointer;
  @include trans-time(1s);
}
* {
    outline: none;
}   
html,
body {
    height: 100%;
    margin: 0;
}
    
body {
    background:black;
    color: white;
    font-family: monospace;
}
    
.form-container {
    margin: 30px 0;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
    
.input-container {
    position: relative;
    margin-top: 2em;
    width: 250px;
}
input,
textarea {
    position: relative;
    width: 100%;
    padding: 6px 0;
    line-height: 160%;
    font-size: 14px;
    background: none;
    color: white;
    border: none;
    border-bottom: 1px solid #aaa;
    }

label {
    position: absolute;
    left: 0;
    top: 0;
    font-size: 14px;
    line-height: 14px;
    padding: 6px 0;
    text-transform: uppercase;
    @include trans-time(0.5s);
}

input:focus+label,
input:valid+label,
textarea:focus+label,
textarea:valid+label {
    transform: translateX(-4.5em);
    opacity: 0.5;
}

input[value]:invalid+label,
textarea[value]:invalid+label{
  color:red;
  transform: translateX(-4.5em);
  opacity:0.5;
}

.sent-wrap{
    @extend %sent-hover;
    #sent{
        @extend %sent-hover;
        z-index: 2;
    }
    &:after{
        content: 'CLICK!';
        line-height: 34px;
        position: absolute;
        text-align: center;
        color: black;
        opacity: 0;
        top: 0;
        left: 0;
        height: 100%;
        background: white;
        @include trans-time(0.5s);
        width: 100%;
    
    }
    &:hover{
        #sent{
           opacity: 0;
        }
        &:after{
           opacity: 1;
        }
      }
}
</style>
<script>
$('input, textarea').on('input',function(){
  this.setAttribute('value', this.value);
});
</script>

                </head>";
    
   echo "<body>";
    require 'mysql.php';
     echo "<form action='index1.php' method=POST align='right'>";
    echo "<nav class='navbar navbar-default' role='navigation'><ul class='nav nav-pills'> <li role='presentation' class='active'><font color='black'>";
    echo  $_SESSION['name'] . " </font></li> <li role='presentation'><font color='black'>您好  身分:" .       $_SESSION['ident'] . "</font></li>  " . "    <li role='presentation'><button  name='func' type='submit' value='logout_action' class='btn btn-danger'><span class='glyphicon glyphicon-share' aria-hidden='true'>登出</span></button><br><br></li><li role='presentation'><button  name='func' type='submit' value='show_homepage' class='btn btn-danger'><span class='glyphicon glyphicon-home' aria-hidden='true'>首頁</span></button><br><br></li></ul></nav>";
    echo "<br><br>";
    
    if ($_SESSION['type']==1) {
  
  

        echo '<table  class="table table-condensed" align="center">';
        echo "<tr ><td rowspan='6'><img src='http://www.kymco.com.tw/products/newProduct/G6_150_2015/360images/color01/7.png' alt='' class='img-rounded'></td><td colspan='6' align='center' style='font-size:0.8cm;'>使用功能</td><td></td><td></td><td></td><td></td><td></td></tr>";
        echo "<tr><td>";
        echo "<button type='submit' name='func' value='show_product_manager' class='btn btn-primary'>商品管理</button>";
        echo "</td><td>";
        echo "<button type='submit' name='func' value='show_purchase_manager' class='btn btn-primary'>採購管理</button>";
        echo "</td><td>";
        echo "<button type='submit' name='func' value='show_order_manager' class='btn btn-primary'>訂單管理</button>";
        echo "</td><td>";
        echo "<button type='submit' name='func' value='show_employee_manager' class='btn btn-primary'>員工管理</button>";
        echo "</td><td>";
        echo "<button type='submit' name='func' value='show_customer_manager' class='btn btn-primary'>客戶管理</button>";
        echo "</td><td>";
        echo "<button type='submit' name='func' value='show_supplier_manager' class='btn btn-primary'>供應商管理</button>";
        echo '</td></tr>';
        echo '</table>';
        
    }else if ($_SESSION['type']==2||$type==2) {
        echo '<table    class="table table-condensed" align="center">';
         echo "<tr><td rowspan='2'><img src='http://www.kymco.com.tw/products/newProduct/G6_150_2015/360images/color01/7.png' alt='' class='img-rounded'></td><td colspan='6' align='center' style='font-size:0.8cm;'>使用功能</td><td></td><td></td><td></td></tr>";
        echo "<tr><td>";
        echo "<button type='submit' name='func' value='show_product_manager' class='btn btn-primary'>商品管理</button>";
        echo "</td><td>";
        echo "<button type='submit' name='func' value='show_purchase_manager' class='btn btn-primary'>採購管理</button>";
        echo "</td><td>";
        echo "<button type='submit' name='func' value='show_order_manager' class='btn btn-primary'>訂單管理</button>";
        echo "</td><td>";
        echo "<button type='submit' name='func' value='show_customer_manager' class='btn btn-primary'>客戶管理</button>";
        echo "</td><td>";
    }
    
    
    echo "</form>";
    echo "</body>";
    echo "</html>";
}
?>