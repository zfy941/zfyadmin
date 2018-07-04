<?php
namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    /**
     * 初始化
     */
    public function initialize()
    {
		//登陆验证
        if (!session('?admin_user')) {
            $this->redirect('login/login');
        }
    }



}
