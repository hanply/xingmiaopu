<?php
namespace admin\controllers;

use Yii;
use admin\services\Admin;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{

    public $menu_code = 0;
    public $cssfiles = [];
    public $jsfiles = [];
    public $breadcrumb = [];

    // Index
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        }
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $this->layout = false;
            return $this->render('index');
        }
        return $this->render('index');
    }

    // Login
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $request = Yii::$app->request;
        if ($request->isPost) {
            Yii::$app->helper->returnJson(Admin::login($request->post()));
        } else {
            $this->layout = false;
            return $this->render('login');
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
