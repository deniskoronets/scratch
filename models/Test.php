<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property int $id
 * @property string $title
 *
 * @property TestQuestions[] $questions
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tests';
    }

    public static function listOf()
    {
        $tmp = [];

        foreach (self::find()->all() as $row) {
            $tmp[$row['id']] = $row['title'];
        }

        return $tmp;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function getQuestions()
    {
        return $this->hasMany(TestQuestions::class, ['test_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }
}
