<?php
use yii\helpers\Url;
?>
<div class="view" id="viewAdminChangePasswd" style="margin-bottom: 40px">
    <div class="view-head clearfix">
        <h1 style="padding-left: 15px">修改登录密码</h1>
        <div class="toolbar btn-group">
            <a class="btn btn-primary" href="<?= Url::to('index')?>"><i class="icon-reply"></i>返回个人中心</a>
        </div>
    </div>
    <div class="view-body" style="padding-top: 10px">
        <form class="form-horizontal" method="post" id="formAdd" role="form">
            <input type="hidden" name="csrfAdmin" value="<?= Yii::$app->request->csrfToken?>">
            <div class="form-group">
                <label class="control-label"><b>*</b>原密码</label>
                <div>
                    <div>
                        <input type="text" class="form-control width-40 inline" name="realname" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><b>*</b>新密码</label>
                <div>
                    <div>
                        <input type="text" class="form-control width-40 inline" name="mobile" autocomplete="off">
                    </div>
                    <div class="help-info">密码为6-12位任意字符</div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><b>*</b>确认新密码</label>
                <div>
                    <div>
                        <input type="text" class="form-control width-40 inline" name="email" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-success submitBtn" type="submit"><i class="icon-ok"></i>保存</button>
                <button class="btn btn-default" type="reset"><i class="icon-undo"></i>取消</button>
            </div>
        </form>
    </div>  
</div>
