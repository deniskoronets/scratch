<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Все добре!!!';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Дякуємо за надіслану відповідь. Бажаємо звершень у вашому навчанні.
    </p>
    <p>
        <?= Html::a('Завантажити додаткове рішення', ['send'], ['class' => 'btn btn-success']) ?>
    </p>
    
</div>
