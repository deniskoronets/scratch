<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Перегляд після реєстрації';
$this->params['breadcrumbs'][] = ['label' => 'Користувач', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
    	<tr>
    		<td>Username</td>
    		<td><?= $model->username ?></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><?= $model->password ?></td>
		</tr>
	</table>

	<?= Html::a('Додати ще користувача', ['create'], ['class' => 'btn btn-success']) ?>

</div>
