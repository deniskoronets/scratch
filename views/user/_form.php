<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$teachers = [];

foreach (\app\models\User::findAll(['is_teacher' => 1]) as $t) {
    $teachers[$t->fio] = $t->fio;
}

$classes = ['' => 'Без классу'];
foreach (\app\models\ClassModel::find()->all() as $c) {
    $classes[$c->id] = $c->name;
}

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fio')->textInput() ?>

    <?= $form->field($model, 'school')->textInput() ?>

    <?= $form->field($model, 'class_id')->dropDownList($classes) ?>

    <?= $form->field($model, 'fio_teacher')->dropDownList($teachers) ?>

    <?= $form->field($model, 'username')->textInput() ?>


    <?php if (!($model instanceof \app\models\User)) { ?>
    <?= $form->field($model, 'password')->textInput() ?>
    <?php } ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'is_teacher')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
