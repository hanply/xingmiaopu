$(function(){
    $("#loginBtn").attr("disabled", !($("#account").val() && $("#passwd").val()));
    $(document).on('click', '.toolbar a[data-target]', function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $('.widget-box.visible').removeClass('visible');
        $(target).addClass('visible');
    });
    $("#loginForm input").keyup(function(){
        $("#loginBtn").attr("disabled", !($("#account").val() && $("#passwd").val()));
    })
    $("#loginBtn").click(function(){
        $(this).attr("disabled", true).html('<span class="bigger-110">登录中 ...</span>');
        var csrfAdmin = $("#csrfAdmin").val(), 
            account = $("#account").val(), 
            passwd = $("#passwd").val(),
            rememberMe = $("#rememberMe").is(":checked") ? 1 : 0;
        $.ajax({
            method: 'post',
            data:{
                csrfAdmin: csrfAdmin,
                account: account,
                passwd: passwd,
                rememberMe: rememberMe,
            },
            dataType: 'json',
            success: function(response) {
                if(response.code==0) {
                    layer.msg(response.msg, {offset: '10px', icon:1}, function(){
                        window.location.href = '/';
                    });
                }else{
                    layer.msg(response.msg, {offset: '10px', icon:5}, function(){
                        $("#loginBtn").attr("disabled", false).html('<i class="icon-key"></i> <span class="bigger-110">登录</span>');
                    });
                }
            },
            fail: function() {
                layer.msg('登录失败，请重试', {offset: '10px', icon:5}, function(){
                    $("#loginBtn").attr("disabled", false).html('<i class="icon-key"></i> <span class="bigger-110">登录</span>');
                });
            }
        })
    })
})