<?php
namespace app\admin\model;

use think\Model;

class AdminUser extends Model
{
    /**
     * 修改资料
     */
    public function edit($data)
    {
        $where = array('id' => session('admin_user.id'), 'password' => md5($data['password']));
        if (!$this->where($where)->find()) {
            return '旧密码错误';
        }
        if (!empty($data['newPwd']) && $data['newPwd'] == $data['confirmPwd']) {
            $res = $this->force()->save([
                'password' => md5($data['newPwd']),
                'head_img' => $data['head_img']
            ], ['id' => session('admin_user.id')]);
            return $res ? true : '修改失败';
        }
        return '新密码不一致或为空';
    }

    /** 
     * 关联分组模型
     */
    public function group()
    {
        return $this->belongsToMany('AuthGroup', 'AuthGroupAccess', 'group_id', "uid");
    }


}