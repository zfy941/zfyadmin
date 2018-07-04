<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Login extends Controller
{
    /**
     * 登陆
     */
    public function login()
    {
        if (request()->isPost()) {
            $post = input('post.');
            $this->check($post['code']);

            $where = array('name' => $post['name'], 'password' => md5($post['password']));
            $res = Db::name('AdminUser')
                ->where($where)->alias('u')
                ->join('__AUTH_GROUP_ACCESS__ a', 'u.id=a.uid')
                ->field('u.*,a.group_id')->find();

            if (!$res) {
                $this->error('用户名或密码错误！');
            }

            if ($res['status'] !== 1) {
                $this->error('此账号已被禁用');
            }

            session('admin_user', $res);
            $this->success('登陆成功', url('admin/index/index'));
        }
        return view();
    }

    /**
     * 验证码检测
     */
    public function check($code = '')
    {
        if (!captcha_check($code)) {
            $this->error('验证码错误');
        }
        return true;
    }

    /**
     * 退出登陆
     */
    public function loginout()
    {
        session(null);
        $this->success('退出成功', url('admin/login/login'));
    }

}
