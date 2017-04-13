var dialog = {
    // 错误弹出层
    error: function(message) {
       return layer.open({
            content:message,
            icon:2,
            title : '错误提示',
        });
    },

    //成功弹出层
    success : function(message) {
        var index=layer.open({
            content : message,
            icon : 1,
            yes : function(){
              layer.close(index);   
            },
        });
    },

    // 确认弹出层
    confirm : function(message,fn) {
       var  index=layer.open({
            content : message,
            icon:3,
            btn : ['是','否'],
            yes : function(){
                dialog.close(index);
                fn();
            },
        });
    },

    //无需跳转到指定页面的确认弹出层
    toconfirm : function(message) {
        layer.open({
            content : message,
            icon:3,
            btn : ['确定'],
        });
    },
    loading:function(number,color){
        var num=2,_color='#fff';
        if(num!=undefined){
            num=number
        }
        if(color!=undefined){
            _color=color;
        }
        var index=layer.load(num,{
            shade:[0.1,_color]
        });
        return index;

    },
    html:function(html,w,h){
        var width,height;
        if(w!=undefined && h!=undefined){
            width=w;
            height=h;
        }else{
            width='420px';
            height='240px';
        }
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: [width, height], //宽高

            content: html,

        });
    },
    tab:function(arr,w,h){
        var w,h;
        if(w!=undefined && h!=undefined){
            width=w;
            height=h;
        }else{
            width='600px';
            height='300px';
        }
        layer.tab({
                area:[w,h],
                tab:arr,
        })
    },
    smile:function(message){
        layer.msg(message,{icon:6});
    },
    sad:function(message){
        layer.msg(message,{icon:5});
    },
    close:function(index){
        if(index==undefined){
           alert('close 方法要穿index(数字)');
            return;
        }
        layer.close(index);
    },
    /*$.getJSON('test/photos.json?v='+new Date, function(json){
     layer.photos({
     photos: json //格式见API文档手册页
     ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机
     });
     });*/
}

