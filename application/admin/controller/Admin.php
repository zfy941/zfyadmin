<?php
namespace app\admin\controller;

use think\Db;
use app\admin\model\AdminUser;


class Admin extends Base
{
    /**
     * 修改个人资料
     */
    public function edit_user()
    {
        if (request()->isAjax() && request()->isPost()) {
            $post = input('post.');
            $res = model('AdminUser')->edit($post);
            if ($res === true) {
                $this->success('修改成功');
            }
            $this->error($res);
        }
        return view();
    }

    /**
     * 用户列表
     */
    public function user(AdminUser $adminUser)
    {
        if (request()->isAjax()) {
            //获取总条数
            $list = $adminUser->with('group')->select();
            $count = count($list);
            //获取当前页数
            $page = input('get.page');
            //获取每页显示的条数
            $limit = input('get.limit');
            //计算出从那条开始查询
            $tol = ($page - 1) * $limit + 1;
            // 查询出当前页数显示的数据
            $list = $adminUser->with('group')->where("id", ">=", $tol)->limit($limit)->select();
            return json(['code' => 0, 'data' => $list, "count" => $count, 'msg' => '查询成功']);
        }
        
        return view();
    }

    /**
     * 添加用户
     */
    public function user_add(AdminUser $adminUser)
    {
        if (request()->isPost()) {
            $post = input('post.');
            $res = $this->model->allowField(true)->save($post);
            if (!$res) {
                $this->error('添加失败');
            }
            $this->success('添加成功');
        }

        if (request()->isGet()) {
            $group = Db::name('AuthGroup')->select();
            $this->assign('group',$group);
            return view();
        }
       
    }




}
