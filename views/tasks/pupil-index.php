<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
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

                    if (\app\models\TasksSubmits::find()->where(['user_id' => Yii::$app->user->id, 'task_id' => $model->id])->exists()) {
                        if ($model->blocked_by_test_id) {
                            $btn[] = '<a href="#" class="btn btn-warning">Пройти тест</a>';
                        } else {
                            $btn[] = 'Вы уже отправили ответ';
                        }
                    } else {
                        $btn[] = '<a href="' . \yii\helpers\Url::to(['tasks/pupil-view', 'id' => $model->id]) . '" class="btn btn-success">Просмотр</a>';
                    }

                    return implode(' ', $btn);
                }
            ]
        ],
    ]); ?>
</div>
