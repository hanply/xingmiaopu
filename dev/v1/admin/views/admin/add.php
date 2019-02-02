<?php
use yii\helpers\Url;
?>
<div class="view" id="viewAdminAdd" style="margin-bottom: 40px">
    <div class="view-head clearfix">
        <h1 style="padding-left: 15px">新增</h1>
        <div class="toolbar btn-group">
            <a class="btn btn-primary" data-url="/admin/index"><i class="icon-reply"></i>返回列表</a>
        </div>
    </div>
    <div class="view-body" style="padding-top: 10px">
        <form class="form-horizontal" method="post" id="formAdd" role="form">
            <input type="hidden" name="csrfAdmin" value="<?= Yii::$app->request->csrfToken?>">
            <div class="form-group">
                <label class="control-label"><b>*</b>姓名</label>
                <div>
                    <div>
                        <input type="text" class="form-control width-40 inline" name="realname" autocomplete="off">
                    </div>
                    <div class="help-info">不超过30个字符</div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label no-padding-top">性别</label>
                <div>
                    <div class="labels">
                        <label>
                            <input name="sex" value="1" class="ace" type="radio" checked><span class="lbl"> 男</span>
                        </label>
                        <label>
                            <input name="sex" value="2" class="ace" type="radio"><span class="lbl"> 女</span>
                        </label>
                        <label>
                            <input name="sex" value="3" class="ace" type="radio"><span class="lbl"> 未知</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><b>*</b>手机号</label>
                <div>
                    <div>
                        <input type="text" class="form-control width-40 inline" name="mobile" autocomplete="off">
                    </div>
                    <div class="help-info">可用于登录、找回密码等</div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">邮箱</label>
                <div>
                    <div>
                        <input type="text" class="form-control width-40 inline" name="email" autocomplete="off">
                    </div>
                    <div class="help-info">可用于登录、找回密码等</div>
                </div>
            </div>
            <?php if (Yii::$app->params['rbac']):?>
            <div class="form-group">
                <label class="control-label">角色</label>
                <div>
                    <div>
                        <select name="role_id" class="form-control width-40 inline">
                            <option value="0">请选择</option>
                            <?php foreach($roles as $k=>$v):?>
                            <option value="<?= $v['id']?>"><?= $v['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="help-info">
                        <a class="btn btn-sm btn-white" href="<?= Url::to('rbac/role/add')?>" target="_blank"><i class="icon-plus"></i>新增角色</a>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <div class="form-group">
                <label class="control-label no-padding-top align-top">备注</label>
                <div>
                    <div>
                        <textarea type="text" class="form-control width-40" rows="3" name="intro"></textarea>
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
