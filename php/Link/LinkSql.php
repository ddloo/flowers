<?php
    //封装连接数据库类
    class LinkSql extends mysqli{
        private $host = "";
        private $port = "";
        private $db = "";
        private $admin = "";
        private $password = "";

        public $isLinkSql = false;

        public function __construct(){
            $this->host = app::$host;
            $this->port = app::$port;
            $this->db = app::$db;
            $this->admin = app::$admin;
            $this->password = app::$password;

            parent::__construct($this->host, $this->admin, $this->password, $this->db, $this->port);

            if(!$this->connect_error){
                $this->set_charset("utf8");
                $this->isLinkSql = true;
            }
        }
    }