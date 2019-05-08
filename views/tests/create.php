<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'Додати тест';
$this->params['breadcrumbs'][] = ['label' => 'Тести', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'variants' => $variants,
    ]) ?>

</div>
