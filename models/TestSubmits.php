<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_submits".
 *
 * @property int $id
 * @property int $user_id
 * @property int $test_id
 * @property double $percent_pass
 * @property string $passed_at
 */
class TestSubmits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_submits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id'], 'integer'],
            [['percent_pass'], 'number'],
            [['passed_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'test_id' => 'Test ID',
            'percent_pass' => 'Percent Pass',
            'passed_at' => 'Passed At',
        ];
    }

    public function getTest()
    {
        return $this->hasOne(Test::class,['id' => 'test_id']);
    }

    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
