<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClassModel */

$this->title = 'Create Class Model';
$this->params['breadcrumbs'][] = ['label' => 'Class Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
