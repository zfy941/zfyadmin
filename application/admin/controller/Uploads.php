<?php
namespace app\admin\controller;

class Uploads extends Base
{
    /**
     * layui单图
     */
    public function layui_img()
    {
        $file = request()->file('file');
        $info = $file->move('./uploads');

        if ($info) {
            $src = '/uploads/' . $info->getSaveName();
            $data = ["code" => 1, "msg" => '上传成功', "src" => $src];
        } else {
            $data = ["code" => 0, "msg" => $file->getError()];
        }
        return json($data);
    }



}
