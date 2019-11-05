<?php
    include_once('LinkSql.php');
    class LoginUser extends LinkSql{
        //连接数据库
        public function __construct()
        {
            parent::__construct();
        }

        //判断用户名是否存在
        public function usernameIsExist($username){
            $result = $this->query('select `username` from `user` where `username` = "'.$username.'"');
            if($result->num_rows === 0){
                //用户不存在
                return 0;
            }
            return 1;
        }

        //判断邮箱是否存在
        public function emailIsExist($email){
            $result = $this->query('select `$email` from `user` where `$email` = "'.$email.'"');
            if($result->num_rows === 0){
                //用户不存在
                return 0;
            }
            return 1;
        }

        //判断用户输入账号密码是否错误
        public function auth($keyword, $password, $isUsername){
            $userExist = NULL;
            $type = NULL;
            if($isUsername){
                $userExist = $this->usernameIsExist($keyword);
                if($userExist === 0){
                    //用户名不存在
                    return 0;
                }
                $type = 'username';
            }
            else{
                $userExist = $this->emailIsExist($keyword);
                if($userExist === 0){
                    //邮箱不存在
                    return 0;
                }
                $type = 'email';
            }

            $result = $this->query('select * from `user` where `password` = "'.$password.'" and `'.$type.'` = "'.$keyword.'"');
            //查询错误
            if(!$result){
                return 2;
            }
            else if($result->num_rows !== 0){
                $userMessage = $result->fetch_assoc();
                return $userMessage;
            }
            //账号或者密码错误
            return 3;
        }

    }