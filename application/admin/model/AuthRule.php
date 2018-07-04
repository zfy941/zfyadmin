<?php
namespace app\admin\model;

use think\Model;

class AuthRule extends Model
{
    /**
     * 获取头部顶级菜单
     * @return [array]  [菜单数组]
     */
    public function getTopMenu()
    {
        $where = array('pid' => 0, 'status' => 1, 'is_show' => 1);
        return $this->where($where)->order('sort', 'asc')->select();
    }

    /**
     * 获取左侧菜单
     * @param  [int] $id [上级ID]
     * @return [array]  [菜单数组]
     */
    public function getLeftMenu($id)
    {
        $where = array('status' => 1, 'is_show' => 1);
        $data = $this->where($where)->order('sort', 'asc')->select();
        return $this->getTree($data, $id);
    }

    /**
     * 获取所有菜单
     * @return [array]  [菜单数组]
     */
    public function getAllMenu()
    {
        $data = $this->order('sort', 'asc')->select();
        return $this->getList($data);
    }

    /**
     * 获取树结构
     * @param  [array] $data [菜单]
     * @param  [int] $pid [上级ID]
     * @param  [int] $level [层级]
     * @return [array]  [多维菜单数组]
     */
    public function getTree($data, $pid = 0, $level = 0)
    {
        $arr = array();

        foreach ($data as $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level;
                $v['href'] = url($v['name']);   //菜单跳转链接
                $v['spread'] = false;           //控制菜单收缩
                $v['children'] = $this->getTree($data, $v['id'], $level + 1);
                if (empty($v['children'])) unset($v['children']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * 获取列表
     * @param  [array] $data [菜单]
     * @param  [int] $pid [上级ID]
     * @param  [int] $level [层级]
     * @return [array]  [菜单数组]
     */
    public function getList($data, $pid = 0, $level = 0)
    {
        static $arr = array();

        foreach ($data as $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level;
                $arr[] = $v;
                $this->getList($data, $v['id'], $level + 1);
            }
        }
        return $arr;
    }


}