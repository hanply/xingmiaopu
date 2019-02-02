<?php

namespace admin\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "rbac_role".
 *
 * @property string $id
 * @property integer $belong
 * @property integer $pid
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbac_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['belong', 'pid', 'status', 'updated_at', 'created_at'], 'integer'],
            [['name', 'updated_at', 'created_at'], 'required'],
            [['name'], 'string', 'max' => 30],
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
            'pid' => 'Pid',
            'name' => 'Name',
            'intro' => 'Intro',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
