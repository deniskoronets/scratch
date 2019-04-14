<?php

namespace app\models;

use yii\base\Model;

/**
 * Class PassTestForm
 * @package app\models
 *
 * @property Test $test
 */
class PassTestForm extends Model
{
    /**
     * @var Test
     */
    private $model;

    public $answers;

    public function __construct(Test $model)
    {
        $this->model = $model;

        parent::__construct();
    }

    public function getTest()
    {
        return $this->model;
    }

    public function rules()
    {
        return [
            ['answers', 'required'],
        ];
    }

    public function submit()
    {
        $correct = 0;

        //var_dump($this->answers); exit;

        foreach ($this->model->questions as $question) {
            if ($question->right_variant == $this->answers[$question->id]) {
                $correct++;
            }
        }

        $percentPass = $correct / $this->model->getQuestions()->count() * 100;

        $result = new TestSubmits();
        $result->setAttributes([
            'user_id' => \Yii::$app->user->id,
            'test_id' => $this->model->id,
            'percent_pass' => $percentPass,
            'passed_at' => date('Y-m-d H:i:s'),
        ]);
        return $result->save();
    }
}