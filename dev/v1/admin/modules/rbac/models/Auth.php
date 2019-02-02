<?php

namespace admin\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "rbac_auth".
 *
 * @property string $id
 * @property integer $belong
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $intro
 * @property integer $status
 */
class Auth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbac_auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['belong', 'status'], 'integer'],
            [['controller', 'action', 'intro'], 'required'],
            [['module', 'controller', 'action'], 'string', 'max' => 30],
            [['intro'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'belong' => 'Belong',
            'module' => 'Module',
            'controller' => 'Controller',
            'action' => 'Action',
            'intro' => 'Intro',
            'status' => 'Status',
        ];
    }
}
