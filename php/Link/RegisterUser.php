<?php
    include_once('LinkSql.php');
    class RegisterUser extends LinkSql{
        //连接数据库
        public function __construct()
        {
            parent::__construct();
        }
        //判断用户是否已被注册
        public function usernameIsExist($username){
            $result = $this->query('select `username` from `user` where `username` = "'.$username.'"');
            if($result->num_rows === 0){
                //用户不存在
                return 0;
            }
            return 1;
        }

        //判断邮箱是否已被注册
        public function emailIsExist($email){
            $result = $this->query('select `email` from `user` where `email` = "'.$email.'"');
            if($result->num_rows === 0){
                //用户不存在
                return 0;
            }
            return 1;
        }
        //用户注册
        public function registerUser($username, $email, $password){
            $isUsername = $this->usernameIsExist($username);
            $isEmail = $this->emailIsExist($email);
            if ($isUsername === 0 && $isEmail === 0){
                $password = md5($password);
                $userRegister = $this->query('insert into `user` (`username` , `password`, `email`) 
                                                  values ("'.$username.'", "'.$password.'","'.$email.'")');
                return 0;
            }
            else if($isUsername === 1){
                //用户名已经存在
                return 1;
            }
            else if($isEmail === 1){
                //邮箱已经存在
                return 2;
            }
        }
    }

