<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Завантажити рішення';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

	    <?= $form->field($model, 'answer')->fileInput() ?>

	    <button type="submit" class="btn btn-success">Відправити на перевірку</button>

	<?php ActiveForm::end() ?>

</div>
