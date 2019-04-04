<?php

namespace app\models;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\base\Model;

class TestCreateForm extends Model
{
    public $title;

    public $questions = [];

    public function rules()
    {
        return [
            [['title', 'questions'], 'safe'],
        ];
    }

    public function save()
    {
        $model = new Test();
        $model->title = $this->title;
        $model->save();;

        foreach ($this->questions as $q) {
            $question = new TestQuestions();
            $question->setAttributes($q);
            $question->test_id = $model->id;

            $question->save();
        }

        return true;
    }
}