<?php
   
    
    unset($_SESSION['name']);
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

                </head>";
     echo "<title>KYMCO 進銷存系統</title>
                    <meta charset='UTF-8'>
                     <link href='../css/bootstrap.min.css' rel='stylesheet' media='screen'>
                    <link href='../css/bootstrap.css' rel='stylesheet' media='screen'>
                    <link href='../css/starter-template.css' rel='stylesheet' media='screen'>
                     <link rel='icon' href='/DB/123.jpg'>";
    echo "<div class='alert alert-success' role='alert'>登出中..</div>";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index1.php>';

?>