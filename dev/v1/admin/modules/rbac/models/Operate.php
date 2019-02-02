<?php

namespace admin\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "rbac_operate".
 *
 * @property string $id
 * @property integer $belong
 * @property string $pid
 * @property integer $code
 * @property string $name
 * @property string $link
 * @property string $icon
 * @property integer $type
 * @property integer $is_show
 * @property integer $sort
 * @property string $intro
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class Operate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbac_operate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['belong', 'pid', 'code', 'type', 'is_show', 'sort', 'status', 'updated_at', 'created_at'], 'integer'],
            [['code', 'name', 'updated_at', 'created_at'], 'required'],
            [['name'], 'string', 'max' => 10],
            [['link'], 'string', 'max' => 255],
            [['icon', 'intro'], 'string', 'max' => 30],
            [['code'], 'unique'],
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
            'code' => 'Code',
            'name' => 'Name',
            'link' => 'Link',
            'icon' => 'Icon',
            'type' => 'Type',
            'is_show' => 'Is Show',
            'sort' => 'Sort',
            'intro' => 'Intro',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
