<?php
namespace admin\controllers;

use Yii;
use yii\web\Controller;
// 基础控制器
class CommonController extends Controller
{

    public $cssfiles = [];
    public $jsfiles = [];
    public $breadcrumb = [];
    
    public function init()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
    }

}