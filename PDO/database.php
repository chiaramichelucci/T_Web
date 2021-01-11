<?php
    $host = '127.0.0.1';
    $db   = 'magnacad';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';
    
    $dsn = "mysql:host=".$host.";dbname=".$db.";charset=".$charset;
    $opt = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
        //\PDO::ATTR_PERSISTENT => TRUE;           per fare in modo che la connesione non si chiuda dopo che finisce
    ];
    $pdo = new \PDO($dsn, $user, $pass, $opt);
?>