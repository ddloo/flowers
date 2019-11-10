<?php
//入口文件
    class app{
        public static $host = "localhost";
        public static $port = "3306";
        public static $db = "florist";
        public static $admin = "root";
        public static $password = "";
        public static $base = __DIR__;
    }

    $handle = $_GET['handle'];
    $method = $_GET['method'];

    include_once(app::$base."/Handle/".$handle.".php");

    $method();