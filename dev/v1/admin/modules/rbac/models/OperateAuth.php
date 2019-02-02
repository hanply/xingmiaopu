<?php

namespace admin\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "rbac_operate_auth".
 *
 * @property string $id
 * @property string $operate_id
 * @property string $auth_id
 * @property integer $status
 */
class OperateAuth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbac_operate_auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operate_id', 'auth_id'], 'required'],
            [['operate_id', 'auth_id', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'operate_id' => 'Operate ID',
            'auth_id' => 'Auth ID',
            'status' => 'Status',
        ];
    }
}
