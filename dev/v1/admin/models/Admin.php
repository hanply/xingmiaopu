<?php

namespace admin\models;

use Yii;
use admin\modules\rbac\models\Role;

/**
 * This is the model class for table "admin".
 *
 * @property string $id
 * @property string $account
 * @property string $realname
 * @property string $mobile
 * @property string $email
 * @property string $role_id
 * @property string $headimg_url
 * @property string $passwd
 * @property integer $sex
 * @property string $intro
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account', 'realname', 'passwd', 'updated_at', 'created_at'], 'required'],
            [['account', 'mobile', 'role_id', 'sex', 'status', 'updated_at', 'created_at'], 'integer'],
            [['realname'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],
            [['headimg_url'], 'string', 'max' => 255],
            [['passwd'], 'string', 'max' => 60],
            [['intro'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account' => 'Account',
            'realname' => 'Realname',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'role_id' => 'Role ID',
            'headimg_url' => 'Headimg Url',
            'passwd' => 'Passwd',
            'sex' => 'Sex',
            'intro' => 'Intro',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class' => \yii\behaviors\AttributeBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'passwd',
                ],
                'value' => function ($event) {
                    return Yii::$app->security->generatePasswordHash(Yii::$app->params['default_passwd']);
                },
            ],
            [
                'class' => \yii\behaviors\AttributeBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'account',
                ],
                'value' => function ($event) {
                    $lastAccount = self::find()->select('account')->orderBy('id desc')->asArray()->one();
                    return (string)($lastAccount['account'] + 1);
                },
            ],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios['login'] = ['account', 'passwd'];
        $scenarios['changePasswd'] = ['passwd'];
        $scenarios['add'] = ['realname', 'mobile', 'email', 'sex', 'intro'];
        $scenarios['edit'] = ['realname', 'mobile', 'email', 'sex', 'intro'];
        
        return $scenarios;
    }

    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id'])
            ->onCondition('rbac_role.belong=:belong and rbac_role.status>:status', [':belong' => 1, ':status' => -1]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
