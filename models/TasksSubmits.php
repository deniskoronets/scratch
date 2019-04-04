<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks_submits".
 *
 * @property int $id
 * @property string $user_id
 * @property string $file_path
 * @property string $submitted_at
 */
class TasksSubmits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks_submits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id','submitted_at', 'task_id'], 'safe'],
            [['file_path'], 'string', 'max' => 255],
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
            'file_path' => 'File Path',
            'submitted_at' => 'Submitted At',
        ];
    }
}
