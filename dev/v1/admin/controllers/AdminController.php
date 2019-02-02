<?php
namespace admin\controllers;
use Yii;
use admin\services\Admin;
use admin\modules\rbac\services\Role;
class AdminController extends CommonController
{
    // 列表
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $this->breadcrumb = ['系统', '人员管理'];
            $this->jsfiles = ['plugin' => ['laydate/laydate'], 'admin'];

            $data = Admin::getList(\Yii::$app->request->queryParams);
            // 获取所有的角色
            $roles = \admin\modules\rbac\models\Role::find(['status'=>1])->asArray()->all();
            $this->layout = false;
            return $this->render('index', [
                'data'  => $data,
                'roles' => $roles,
            ]);
        }

    }

    public function actionAdd()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            if ($request->isPost) {
                $result = Admin::add($request->post());
                if ($result === true) {
                    Yii::$app->helper->returnJson(['code'=>0, 'msg'=>'保存成功']);
                }
                Yii::$app->helper->returnJson(['code'=>-1, 'msg'=>$result]);
            }else{
                $this->breadcrumb = ['系统', '管理员设置'];
                $this->jsfiles = ['plugin'=>['jquery.validate.min', 'jquery.form.min'], 'admin'];
                $roles = \admin\modules\rbac\models\Role::find(['status'=>1])->asArray()->all();
                $this->layout = false;
                return $this->render('add', [
                    'roles' => $roles
                ]);
            }
        }
    }

    public function actionEdit()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            if ($request->isPost){
                $result = Admin::edit($request->post());
                if ($result === true) {
                    Yii::$app->helper->returnJson(['code'=>0, 'msg'=>'保存成功']);
                }
                Yii::$app->helper->returnJson(['code'=>-1, 'msg'=>$result]);
            }else{
                $this->breadcrumb = ['系统', '管理员设置', '编辑'];
                $this->jsfiles = ['plugin'=>['jquery.validate.min', 'jquery.form.min'], 'admin'];

                $id = $request->get('id');
                if ($id!=1) {
                    $data = \admin\models\Admin::find()->where(['>', 'admin.status', -1])->andWhere(['id'=>$id])->asArray()->one();
                    if ($data) {
                        // 获取所有的角色
                        $roles = \admin\modules\rbac\models\Role::find(['status'=>1])->asArray()->all();
                        $this->layout = false;
                        return $this->render('edit', [
                            'data'  => $data,
                            'roles' => $roles,
                        ]);
                    }
                }
                $this->redirect('/site/error');
            }
        }
    }

    // 删除
    public function actionRemove()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            if (Admin::changeStatus($request->get())) {
                Yii::$app->helper->returnJson(['code'=>0, 'msg'=>'删除成功']);
            }
            Yii::$app->helper->returnJson(['code'=>-1, 'msg'=>'删除失败']);
        }
    }

    public function actionOnoff()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            if (Admin::changeStatus($request->get())) {
                Yii::$app->helper->returnJson(['code'=>0, 'msg'=> ($request->get('status')==1?'启用':'停用').'成功']);
            }
            Yii::$app->helper->returnJson(['code'=>-1, 'msg'=>($request->get('status')==1?'启用':'停用').'失败']);
        }
    }

    public function actionDetail()
    {
        return $this->render();
    }

    // 个人中心
    public function actionCenter()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            $this->layout = false;
            return $this->render('center');
        }
    }

    public function actionChangePasswd()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax && $request->isPost) {
            $result = Admin::edit($request->post());
            if ($result === true) {
                Yii::$app->helper->returnJson(['code'=>0, 'msg'=>'保存成功']);
            }
            Yii::$app->helper->returnJson(['code'=>-1, 'msg'=>$result]);
        }else{
            $this->menu_code = 0;
            $this->breadcrumb = ['个人中心'];
            $this->jsfiles = ['plugin'=>['jquery.validate.min', 'jquery.form.min'], 'admin'];
            return $this->render('changePasswd');
        }
    }


}