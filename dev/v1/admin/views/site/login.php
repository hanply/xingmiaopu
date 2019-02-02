<?php
use yii\helpers\Html;
$assets_version =  Yii::$app->params['assets_version'];
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>登录 - 雅爱Mall</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/ace.min.css?v=<?= $assets_version?>" />
    <!--[if lte IE 8]>
    <script src="../components/html5shiv/dist/html5shiv.min.js"></script>
    <script src="../components/respond/dest/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-layout">
<div class="navbar-fixed-top">
    <img src="<?= Yii::$app->params['static_domain']?>/logo.png">
</div>
<div class="login-container">
    <div class="center">
        <h1>
            <i class="icon-leaf green"></i>
            <span class="red">雅爱Mall</span>
            <span class="grey">控制台</span>
        </h1>
        <h4 class="blue">&copy; 北京数字探索科技有限公司</h4>
    </div>
    <div class="space-6"></div>
    <div class="position-relative">
        <div id="login-box" class="login-box visible widget-box no-border">
            <div class="widget-body">
                <div class="widget-main">
                    <h4 class="header blue lighter bigger">
                        <i class="icon-coffee green"></i> 管理员登录
                    </h4>
                    <div class="space-6"></div>
                    <form id="loginForm">
                        <input type="hidden" name="csrfAdmin" id='csrfAdmin' value="<?= Yii::$app->request->csrfToken ?>">
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="text" id="account" autocomplete="off" class="form-control" placeholder="账号/手机号/邮箱" />
                                <i class="icon-user"></i>
                            </span>
                        </label>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="password" id="passwd" autocomplete="off" class="form-control" placeholder="登录密码" />
                                <i class="icon-lock"></i>
                            </span>
                        </label>
                        <div class="space"></div>
                        <div class="clearfix">
                            <label class="inline">
                                <input type="checkbox" id="rememberMe" class="ace" checked />
                                <span class="lbl"> 七天免登陆</span>
                            </label>
                            <button type="button" id="loginBtn" disabled class="width-35 pull-right btn btn-sm btn-primary">
                                <i class="icon-key"></i> <span class="bigger-110">登录</span>
                            </button>
                        </div>
                        <div class="space-4"></div>
                    </form>
                </div>
                <div class="toolbar clearfix">
                    <div>
                        <a href="#" data-target="#forgot-box" class="forgot-password-link">
                            <i class="icon-arrow-left"></i> 忘记密码
                        </a>
                    </div>
                    <div>
                        <a href="#" data-target="#signup-box" class="user-signup-link">
                            注册申请 <i class="icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="forgot-box" class="forgot-box widget-box no-border">
            <div class="widget-body">
                <div class="widget-main">
                    <h4 class="header red lighter bigger">
                        <i class="icon-key"></i> 找回密码
                    </h4>
                    <div class="space-6"></div>
                    <p>输入账号邮箱地址接受电子邮件</p>
                    <form>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="email" class="form-control" placeholder="邮箱地址" />
                                <i class="icon-message"></i>
                            </span>
                        </label>
                        <div class="clearfix">
                            <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                <i class="icon-lightbulb-o"></i>
                                <span class="bigger-110">发送</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="toolbar center">
                    <a href="#" data-target="#login-box" class="back-to-login-link">
                        返回登录 <i class="icon-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div id="signup-box" class="signup-box widget-box no-border">
            <div class="widget-body">
                <div class="widget-main">
                    <h4 class="header green lighter bigger">
                        <i class="icon-users blue"></i> 新用户注册申请
                    </h4>
                    <div class="space-6"></div>
                    <p> 完成以下信息: </p>
                    <form>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="email" class="form-control" placeholder="Email" />
                                <i class="icon-envelope"></i>
                            </span>
                        </label>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="text" class="form-control" placeholder="Username" />
                                <i class="icon-user"></i>
                            </span>
                        </label>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="password" class="form-control" placeholder="Password" />
                                <i class="icon-lock"></i>
                            </span>
                        </label>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="password" class="form-control" placeholder="Repeat password" />
                                <i class="icon-retweet"></i>
                            </span>
                        </label>
                        <label class="block">
                            <input type="checkbox" class="ace" />
                            <span class="lbl">我接受 <a href="#">365易买用户协议</a></span>
                        </label>
                        <div class="space-24"></div>
                        <div class="clearfix">
                            <button type="reset" class="width-30 pull-left btn btn-sm">
                                <i class="icon-refresh"></i>
                                <span class="bigger-110">重置</span>
                            </button>
                            <button type="button" class="width-65 pull-right btn btn-sm btn-success">
                                <span class="bigger-110">提交</span>
                                <i class="icon-arrow-right icon-on-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="toolbar center">
                    <a href="#" data-target="#login-box" class="back-to-login-link">
                        <i class="icon-arrow-left"></i> 返回登录
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--[if !IE]> -->
<script src="/js/jquery-2.0.3.min.js"></script>
<!-- <![endif]-->
<!--[if IE]>
<script src="/js/jquery-1.12.1.js"></script>
<![endif]-->
<script src="/plugin/layer/layer.js"></script>
<script src="/js/login.js?v=<?= $assets_version?>"></script>
</body>
</html>