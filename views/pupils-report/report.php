<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pupils report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'fio',
            'school',
            'class',
            [
                'label' => 'Задания',
                'format' => 'raw',
                'value' => function(User $user) {
                    $html = '<b>Задания:</b>';

                    $html .= '<table class="table">';

                    foreach ($user->submittedTasks as $task) {
                        $html .= '
                            <tr>
                                <td>#' . $task->task_id . ': ' . $task->task->title . ', file: <a href="' . $task->url() . '">' . $task->file_path . '</a></td>
                            </tr>
                        ';
                    }

                    foreach ($user->submittedTests as $test) {
                        $html .= '
                            <tr>
                                <td>#' . $test->test_id . ': ' . $test->test->title . ', ' . $test->percent_pass . '% correct</td>
                            </tr>
                        ';
                    }


                    $html .= '</table>';

                    return $html;
                }
            ]
        ],
    ]); ?>
</div>
