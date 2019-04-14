<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestUpdateForm */

$this->title = 'Update Test: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->test->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if (isset($model->questions)) { ?>
        <table class="table table-bordered">
            <tr>
                <?php foreach ($model->test->questions as $question) { ?>
                    <td>
                        <?= $form->field($model, 'questions[' . $question->id . '][question]')->textInput()->label('Вопрос') ?>

                        <?php for ($j = 1; $j <= 4; $j++) { ?>
                            <?= $form->field($model, 'questions[' . $question->id . '][variant_' . $j . ']')->textInput()->label('Ответ ' . $j) ?>
                        <?php } ?>

                        <?= $form->field($model, 'questions[' . $question->id . '][right_variant]')->dropDownList($variants)->label('Правильный ответ') ?>
                    </td>

                <?php } ?>
            </tr>
        </table>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
