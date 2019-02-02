<?php

namespace admin\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "rbac_role_operate".
 *
 * @property string $id
 * @property string $role_id
 * @property string $operate_id
 * @property integer $status
 */
class RoleOperate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbac_role_operate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'operate_id'], 'required'],
            [['role_id', 'operate_id', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'operate_id' => 'Operate ID',
            'status' => 'Status',
        ];
    }
}
