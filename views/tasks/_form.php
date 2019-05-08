<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */
/* @var $form yii\widgets\ActiveForm */

$classes = ['' => 'Без классу'];
foreach (\app\models\ClassModel::find()->all() as $c) {
    $classes[$c->id] = $c->name;
}

?>

<div class="tasks-form">

    <p>Загружайте картинки на <a href="https://paste.pics" target="_blank">paste.pics</a></p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'test_id')->dropDownList(\app\models\Test::listOf()) ?>

    <?= $form->field($model, 'class_id')->dropDownList($classes) ?>

    <div class="form-group">
        <?= Html::submitButton('Зберігти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
