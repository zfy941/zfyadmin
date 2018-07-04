<?php
namespace app\admin\controller;

class Index extends Base
{
    /**
     * 首页
     */
    public function index()
    {
        $topMenu = model('AuthRule')->getTopMenu();
        $this->assign('topMenu', $topMenu);

        $user = session('admin_user');
        $this->assign('user', $user);

        return view();
    }

    /**
     * 获取左侧菜单
     */
    public function getLeftMenu()
    {
        $id = input('id');
        $leftMenu = model('AuthRule')->getLeftMenu($id);
        return json($leftMenu);
    }

    /**
     * 默认展示页
     */
    public function main()
    {
        return view();
    }

    /**
     * 无权限页面
     */
    public function prohibit()
    {

    }


}
