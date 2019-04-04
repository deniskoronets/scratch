<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_questions".
 *
 * @property int $id
 * @property int $test_id
 * @property string $question
 * @property string $variant_1
 * @property string $variant_2
 * @property string $variant_3
 * @property string $variant_4
 * @property int $right_variant
 */
class TestQuestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'right_variant'], 'integer'],
            [['question', 'variant_1', 'variant_2', 'variant_3', 'variant_4'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'question' => 'Question',
            'variant_1' => 'Variant 1',
            'variant_2' => 'Variant 2',
            'variant_3' => 'Variant 3',
            'variant_4' => 'Variant 4',
            'right_variant' => 'Right Variant',
        ];
    }
}
