layui.use(['form','layer','laydate','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        table = layui.table;
// -----------------------------------列表页操作----------------------------------------------

    //是否置顶
    form.on('switch(is_show)', function(data){
        var index = layer.msg('修改中，请稍候',{icon: 16,time:false,shade:0.8});
        setTimeout(function(){
            layer.close(index);
            if(data.elem.checked){
                layer.msg("置顶成功！");
            }else{
                layer.msg("取消置顶成功！");
            }
        },500);
    })

    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        if($(".searchVal").val() != ''){
            table.reload("listTable",{
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where: {
                    key: $(".searchVal").val()  //搜索的关键字
                }
            })
        }else{
            layer.msg("请输入搜索的内容");
        }
    });



    //点击添加
    $(".add_btn").click(function(){
        var url = $(this).data('url');
        addData(url);
    })
    //添加
    function addData(url)
    {
        var index = layui.layer.open({
            title : "添加数据",
            type : 2,
            content : url,
            success : function(layero, index){
                setTimeout(function(){
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    }

    //批量删除
    $(".delAll_btn").click(function(){
        var checkStatus = table.checkStatus('listTable'),
            data = checkStatus.data,
            idArr = []
            url = $(this).data('url');
        if(data.length > 0) {
            for (var i in data) {
                idArr.push(data[i].id);
            }
            var jsonString = JSON.stringify(idArr);
            layer.confirm('确定删除选中的文章？', {icon: 3, title: '提示信息'}, function (index) {
                $.get(url,{ids : jsonString},function(data){
                    layer.close(index);
                    if (!data.msg) {return;}
                    layer.msg(data.msg);
                    if (data.code==1) {
                        table.reload("listTable")
                    }
                })
            })
        }else{
            layer.msg("请选择需要删除的文章");
        }
    })

    //列表操作
    table.on('tool(list)', function(obj){
        var layEvent = obj.event,
            data = obj.data;

        if(layEvent === 'edit'){ //编辑
            var url = $('input[name="edit-url"]').val();
            editData(url,data.id);
        } else if(layEvent === 'del'){ //删除
            var url = $('input[name="del-url"]').val();
            delData(url,obj);
        } else if(layEvent === 'addlower'){ //添加下级
            var url = $('.add_btn').data('url')+'/id/'+data.id;
            addData(url);
        }
    });
    //修改
    function editData(url,id)
    {
        var index = layui.layer.open({
            title : "修改数据",
            type : 2,
            content : url+'/id/'+id,
            success : function(layero, index){
                setTimeout(function(){
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    }
    //删除
    function delData(url,obj)
    {
        layer.confirm('确定删除这条数据吗？',{icon:3, title:'提示信息'},function(index){
            $.get(url,{id : obj.data.id },function(data){
                layer.close(index);
                if (!data.msg) {return;}
                layer.msg(data.msg);
                if (data.code==1) {
                    obj.del();
                }
            });
        });
    }

// -----------------------------------表单编辑页操作----------------------------------------------

    //提交表单
    form.on("submit(submitForm)",function(data){
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8}),url = $(this).data('url');

        $.post(url,$("#formId").serialize(),function (data){
            top.layer.close(index);
            if (!data.msg) {return;}
            top.layer.msg(data.msg);
            if(data.code==1){
                layer.closeAll("iframe");
                //刷新父页面
                parent.location.reload();
            }
        });
        return false;
    })
});

// -----------------------------------公共方法----------------------------------------------
function timeDate(time) {
    if (time == 0 || time == false) {
        return '无';
    }
    return 1;
}