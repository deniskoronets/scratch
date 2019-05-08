<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Test */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if (isset($model->questions)) { ?>
    <table class="table table-bordered">
        <tr>
        <?php for ($i = 0; $i < 4; $i++) { ?>
                <td>
                    <?= $form->field($model, 'questions[' . $i . '][question]')->textInput()->label('Питання') ?>

                    <?php for ($j = 1; $j <= 4; $j++) { ?>
                        <?= $form->field($model, 'questions[' . $i . '][variant_' . $j . ']')->textInput()->label('Відповідь ' . $j) ?>
                    <?php } ?>

                    <?= $form->field($model, 'questions[' . $i . '][right_variant]')->dropDownList($variants)->label('Правильна відповідь') ?>
                </td>

        <?php } ?>
        </tr>
    </table>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Зберігти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
