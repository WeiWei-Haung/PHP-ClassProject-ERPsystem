<?php

class Database {

    public static  function initDB() {
        $db_host = 'db.mis.kuas.edu.tw';
        $db_name = 's1103137241';
        $db_user = 's1103137241';
        $db_pw = 'B123082315';
        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=UTF8";
        $db = new PDO($dsn, $db_user, $db_pw);
        return $db;
        
    }

}

?>