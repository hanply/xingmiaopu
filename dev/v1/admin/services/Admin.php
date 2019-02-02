<?php
namespace admin\services;
use Yii;
use yii\data\Pagination;
use admin\models\Admin as AdminModel;
class Admin
{
    public static function add($post)
    {
        // 校验手机号
        if (!empty($post['mobile']) && AdminModel::find()->where(['mobile'=>$post['mobile']])->one()) {
            return '手机号已存在';
        }
        if (!empty($post['email']) && AdminModel::find()->where(['email'=>$post['email']])->one()) {
            return '邮箱已存在';
        }
        $admin = new AdminModel;
        $admin->scenario = 'add';
        $admin->realname = $post['realname'];
        $admin->email    = $post['email'];
        $admin->mobile   = $post['mobile'];
        $admin->role_id  = $post['role_id'];
        $admin->intro    = $post['intro'];
        $admin->sex      = $post['sex'];
        if ($admin->save()) {
            return true;
        }
        return false;
    }

    public static function edit($post)
    {
        // 校验手机号
        if (!empty($post['phone']) && AdminModel::find()->where(['phone'=>$post['phone']])->andWhere(['<>', 'id', $post['id']])->one()) {
            return '手机号已存在';
        }
        if (!empty($post['email']) && AdminModel::find()->where(['email'=>$post['email']])->andWhere(['<>', 'id', $post['id']])->one()) {
            return '邮箱已存在';
        }
        $admin = AdminModel::findOne($post['id']);
        $admin->scenario = 'edit';
        $admin->realname = $post['realname'];
        $admin->email    = $post['email'];
        $admin->mobile   = $post['mobile'];
        $admin->role_id  = $post['role_id'];
        $admin->intro    = $post['intro'];
        $admin->sex      = $post['sex'];
        if ($admin->save()) {
            return true;
        }
        return false;
    }

    public static function getList($params)
    {
        $query = AdminModel::find()->where(['>', 'admin.status', -1]);
        $query->andWhere(['<>', 'admin.id', 1]);
        if (!empty($params['key'])) {
            $query->andFilterWhere(['or', ['like', 'admin.realname', $params['key']], ['like', 'admin.account', $params['key']], ['like', 'admin.mobile', $params['key']]]);
        }
        if (!empty($params['role_id'])) {
            $query->andFilterWhere(['admin.role_id'=>$params['role_id']]);
        }
        if (!empty($params['status'])) {
            $query->andFilterWhere(['admin.status'=>$params['status']]);
        }
        if (!empty($params['create_at'])) {
            $rangeStamp = \Yii::$app->helper->rangeStamp($params['create_at']);
            $query->andFilterWhere(['between', 'admin.create_at', $rangeStamp[0], $rangeStamp[1]]);
        }
        $pager = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 20,
            'pageSizeParam' => false,
            'pageParam' => 'p',
        ]);
        $list = $query->select('admin.*,rbac_role.name role_name')
            ->joinWith('role', false)
            ->offset($pager->offset)
            ->orderBy('id desc')
            ->limit($pager->limit)
            ->asArray()
            ->all();
        return ['list'=>$list,'pager'=>$pager];
    }


    /**
     * 改变状态
     * @param  [type] $input [description]
     * @return [type]       [description]
     */
    public static function changeStatus($input)
    {
        $update = \Yii::$app->db->createCommand()
            ->update('admin', [
                'status'     => $input['status'], 
                'updated_at' => time()
            ], ['id' => explode(",", $input['id'])])
            ->execute();
        if ($update!==false) {
            return true;
        }
        return false;
    }
    
    public static function login($post)
    {
        $adminModel = new AdminModel;
        $admin = AdminModel::findOne(['account'=>$post['account']]);
        if($admin && static::validatePasswd($post['passwd'], $admin->passwd)) {
            Yii::$app->user->login($admin, $post['rememberMe'] ? 3600 * 24 * 30 : 0);
            return ['code'=>0, 'msg'=>'登录成功'];
        }
        return ['code'=>-1, 'msg'=>'账号或密码不正确'];
    }

    /**
     * 校验密码
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public static function validatePasswd($passwd, $passwd_hash)
    {
        return Yii::$app->security->validatePassword($passwd, $passwd_hash);
    }


    public static function generatePasswd($passwd=123456)
    {
        return Yii::$app->security->generatePasswordHash($passwd);
    }


}