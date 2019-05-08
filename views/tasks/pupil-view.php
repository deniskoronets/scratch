<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Завдання', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $model->content ?>

    <?= Html::a('Відправити роботу на перевірку', ['send', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

</div>
