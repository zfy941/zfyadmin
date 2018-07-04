<?php
namespace app\admin\controller;

use think\Db;

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




}
