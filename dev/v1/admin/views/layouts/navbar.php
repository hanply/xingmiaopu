<div class="navbar navbar-fixed-top navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">YAIMALL</a>
        </div>
        <ul class="nav navbar-nav nav-tabs navbar-left">
            <li class="active"><a href="#home" data-toggle="tab">商品</a></li>
            <li><a href="#home1" data-toggle="tab">运营</a></li>
            <li><a href="#home2" data-toggle="tab">财务</a></li>
            <li><a href="#home3" data-toggle="tab">统计</a></li>
            <li><a href="#home4" data-toggle="tab">系统</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="purple">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="icon-bell-alt icon-animated-bell"></i>
                    <span class="badge badge-important">8</span>
                </a>
                <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                    <li class="dropdown-header">
                        <i class="icon-warning-sign"></i>
                        8 Notifications
                    </li>
                    <li>
                        <a href="#">
                            <div class="clearfix">
                                <span class="pull-left">
                                    <i class="btn btn-xs no-hover btn-pink icon-comment"></i>
                                    New Comments
                                </span>
                                <span class="pull-right badge badge-info">+12</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="btn btn-xs btn-primary icon-user"></i>
                            Bob just signed up as an editor ...
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="clearfix">
                                <span class="pull-left">
                                    <i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
                                    New Orders
                                </span>
                                <span class="pull-right badge badge-success">+8</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="clearfix">
                                <span class="pull-left">
                                    <i class="btn btn-xs no-hover btn-info icon-twitter"></i>
                                    Followers
                                </span>
                                <span class="pull-right badge badge-info">+11</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            See all notifications
                            <i class="icon-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="green">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="icon-envelope icon-animated-vertical"></i>
                    <span class="badge badge-success">5</span>
                </a>
                <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                    <li class="dropdown-header">
                        <i class="icon-envelope-alt"></i>
                        5 Messages
                    </li>
                    <li>
                        <a href="#">
                            <img src="/image/avatar/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                            <span class="msg-body">
                                <span class="msg-title">
                                    <span class="blue">Alex:</span>
                                    Ciao sociis natoque penatibus et auctor ...
                                </span>
                                <span class="msg-time">
                                    <i class="icon-time"></i>
                                    <span>a moment ago</span>
                                </span>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <img src="/image/avatar/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                            <span class="msg-body">
                                <span class="msg-title">
                                    <span class="blue">Susan:</span>
                                    Vestibulum id ligula porta felis euismod ...
                                </span>

                                <span class="msg-time">
                                    <i class="icon-time"></i>
                                    <span>20 minutes ago</span>
                                </span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/image/avatar/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                            <span class="msg-body">
                                <span class="msg-title">
                                    <span class="blue">Bob:</span>
                                    Nullam quis risus eget urna mollis ornare ...
                                </span>

                                <span class="msg-time">
                                    <i class="icon-time"></i>
                                    <span>3:15 pm</span>
                                </span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="inbox.html">查看全部消息 <i class="icon-arrow-right"></i></a>
                    </li>
                </ul>
            </li>
            <li class="light-blue" style="margin-right: 15px">
                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                    <img class="nav-user-photo img-circle" style="margin: -9px 3px -9px 0" src="/image/avatar/user.jpg" alt="Jason's Photo" />
                    <span class="user-info">
                        <?= Yii::$app->user->identity->realname?>
                    </span>
                    <i class="icon-caret-down"></i>
                </a>
                <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['admin/change-passwd'])?>" target="_blank"><i class="icon-cog"></i> 修改登录密码</a>
                    </li>
                    <li>
                        <a data-url="admin/center" href="#admin/center"><i class="icon-user"></i> 个人中心</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['site/logout'])?>"><i class="icon-off"></i> 退出登录</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>