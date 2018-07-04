layui.use(['form','layer','jquery'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer
        $ = layui.jquery;

    //登录按钮
    form.on("submit(login)",function(data){
        var _this = $(this),url = _this.data('url');
        _this.text("登录中...").attr("disabled","disabled").addClass("layui-disabled");
        $.post(url,$("#formid").serialize(),function (data){
            if (data.code==0) {
                top.layer.msg(data.msg,{icon: 2});
                _this.text("登录").removeAttr("disabled").removeClass("layui-disabled");
                $(".code img").click();
            }else if(data.code==1){
                top.layer.msg(data.msg,{icon: 1});
                if (data.url) setTimeout(function (){window.location.href = data.url;},1000);
            };
        });
    })

    //表单输入效果
    $(".loginBody .input-item").click(function(e){
        e.stopPropagation();
        $(this).addClass("layui-input-focus").find(".layui-input").focus();
    })
    $(".loginBody .layui-form-item .layui-input").focus(function(){
        $(this).parent().addClass("layui-input-focus");
    })
    $(".loginBody .layui-form-item .layui-input").blur(function(){
        $(this).parent().removeClass("layui-input-focus");
        if($(this).val() != ''){
            $(this).parent().addClass("layui-input-active");
        }else{
            $(this).parent().removeClass("layui-input-active");
        }
    })
})
