<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PassTestForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Pass Test: ' . $model->test->title;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->test->title, 'url' => ['view', 'id' => $model->test->id]];
$this->params['breadcrumbs'][] = 'Pass';
?>
<div class="test-pass">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?php foreach ($model->test->questions as $question) { ?>
            <table class="table table-bordered">
                <tr>
                    <td><b><?= $question->question ?></b></td>
                </tr>
                <?php

                $items = [];

                for ($i = 1; $i <= 4; $i++) {
                    $items[$i] = $question['variant_' . $i];
                }
                ?>
                <tr>
                    <td>
                        <?= $form->field($model, 'answers[' . $question->id . ']')->radioList($items, ['separator' => '<br>', 'tag' => 'div'])->label(false) ?>
                    </td>
                </tr>
            </table>
        <?php } ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
