<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Завдання (' . (Yii::$app->user->identity->class ?? '-') . ')';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            [
                'format' => 'raw',
                'value' => function($model) {
                    $btn = [];

                    if ($test = \app\models\TasksSubmits::find()->where(['user_id' => Yii::$app->user->id, 'task_id' => $model->id])->one()) {

                        if ($tmp = \app\models\TestSubmits::find()->where(['user_id' => Yii::$app->user->id, 'test_id' => $model->test_id])->one()) {
                            $btn[] = 'Вы пройшли тест із ' . $tmp->percent_pass . '% правильних відповідей';

                        } elseif ($model->test_id) {
                            $btn[] = '<a href="' . \yii\helpers\Url::to(['tests/pass-test', 'id' => $model->test_id]) . '" class="btn btn-warning">Пройти тест</a>';
                        } else {
                            $btn[] = 'Ви вже відправили відповідь';
                        }
                    }

                    $btn[] = '<a href="' . \yii\helpers\Url::to(['tasks/pupil-view', 'id' => $model->id]) . '" class="btn btn-success">Перегляд завдання</a>';

                    return implode(' ', $btn);
                }
            ]
        ],
    ]); ?>
</div>
