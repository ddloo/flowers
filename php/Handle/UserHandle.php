<?php

    //用户登录
    function auth(){
        $response = [];
        if(!isset($_POST['keyword'], $_POST['password'], $_POST['$isUsername'])){
            $response = [
                'code' => '1000',
                'msg' => '发生了某些未知错误,请联系网站管理员┭┮﹏┭┮'
            ];
            die(json_encode($response));
        }

        include_once (app::$base."/Link/LoginUser.php");

        $login = new LoginUser();

        //登录操作
        $result = $login->auth($_POST['keyword'], $_POST['password'], $_POST['$isUsername']);

        if($result === 0){
            //用户不存在
            $response = [
                'code' => '0001',
                'msg' => '该用户不存在呢o_o ...'
            ];
            die(json_encode($response));
        }
        else if($result === 2){
            //服务器可能发生错误
            $response = [
                'code' => '2000',
                'msg' => '发生了未知错误,请联系网站管理员QAQ'
            ];
            die(json_encode($response));
        }
        else if($result === 3){
            //账号或者密码错误
            $response = [
                'code' => '0002',
                'msg' => '账号或者密码错误的话＞﹏＜'
            ];
            die(json_encode($response));
        }
        else{
            //登录成功
            session_start();
            $_SESSION['uid'] = $result['uid'];
            setcookie('uid', $_SESSION['uid'], time() + 60 * 60 * 24 * 1, '/');
            $response = [
                'code' => '0000',
                'msg' => '登录成功',
                'data' => [
                    'username' => $result['username'],
                    'uid' => $result['uid']
                ]
            ];
            die(json_encode($response));
        }

    }