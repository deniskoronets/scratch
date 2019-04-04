<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property int $teacher_id
 * @property string $content
 * @property int $blocked_by_test_id
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'blocked_by_test_id'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function getBlockingTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'blocked_by_test_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'teacher_id' => 'Teacher ID',
            'content' => 'Content',
            'blocked_by_test_id' => 'Blocked By Test ID',
        ];
    }
}
