<?php

namespace app\models;

use yii\base\Model;

/**
 * Class TestUpdateForm
 * @package app\models
 *
 * @property Test $test
 */
class TestUpdateForm extends Model
{
    private $test;

    public $title;

    public $questions = [];

    public function __construct(Test $test)
    {
        $this->test = $test;

        $this->title = $this->test->title;

        foreach ($this->test->questions as $question) {
            $this->questions[$question->id] = $question;
        }
    }

    public function rules()
    {
        return [
            [['title', 'questions'], 'safe'],
        ];
    }

    public function getTest()
    {
        return $this->test;
    }

    public function save()
    {
        $model = $this->test;
        $model->title = $this->title;
        $model->save();

        foreach ($this->questions as $id => $q) {
            $question = TestQuestions::find()->where(['id' => $id])->one();
            $question->setAttributes($q);

            $question->save();
        }

        return true;
    }
}