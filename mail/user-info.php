<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>

<h2>Добро пожаловать в в систему Мой Scratch</h2>

<p>Ваш логин: <?= $username ?></p>
<p>Пароль: <?= $password ?></p>

<p><?= Html::a('Посетить сайт', Url::home('http')) ?></p>