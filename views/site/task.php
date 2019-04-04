<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Завдання на олімпіаду';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Тут представленні завдання до виконання
    </p>

    <p>
        <a href="">Завдання</a>
    </p>
    <p>
    	<?= Html::a('Перейти до завантаження рішення', ['send'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
