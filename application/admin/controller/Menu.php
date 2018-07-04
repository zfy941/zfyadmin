<?php
namespace app\admin\controller;

use app\admin\model\AuthRule;

class Menu extends Base
{
    protected $model;

    public function __construct(AuthRule $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 后台菜单
     */
    public function menu()
    {
        if (request()->isAjax()) {
            $menu = $this->model->getAllMenu();
            return json(['code' => 0, 'data' => $menu, 'msg' => '查询成功']);
        }
        return view();
    }

    /**
     * 菜单添加
     */
    public function menu_add()
    {
        if (request()->isAjax() && request()->isPost()) {
            $post = input('post.');
            $res = $this->model->allowField(true)->save($post);
            if (!$res) {
                $this->error('添加失败');
            }
            $this->success('添加成功');
        }
        $id = input('param.id', '');
        $menu = $this->model->getAllMenu();

        $this->assign([
            'id' => $id,
            'menu' => $menu
        ]);
        return view();

    }

    /**
     * 菜单修改
     */
    public function menu_edit()
    {
        $id = input('param.id');

        $data = $this->model->get($id);
        $menu = $this->model->getAllMenu();

        $this->assign([
            'data' => $data,
            'menu' => $menu
        ]);
        return view();
    }

    /**
     * 菜单更新
     */
    public function update()
    {
        if (request()->isAjax() && request()->isPost()) {
            $post = input('post.');
            $res = $this->model->isUpdate(true)->allowField(true)->save($post);
            if (!$res) {
                $this->error('修改失败');
            }
            $this->success('修改成功');
        }
    }

    /**
     * 菜单删除
     */
    public function menu_del()
    {
        $id = input('param.id');
        $res = $this->model->where('id', $id)->delete();
        if ($res) {
            $this->success('删除成功');
        }
        $this->error('删除失败');
    }

    /**
     * 批量删除
     */
    public function delAll()
    {
        $ids = json_decode(input('ids'));
        $res = $this->model->where('id', 'in', $ids)->delete();
        if ($res) {
            $this->success('删除成功');
        }
        $this->error('删除失败');
    }

    /**
     * 选择图标
     */
    public function choice_icon()
    {
        return view();
    }



}
