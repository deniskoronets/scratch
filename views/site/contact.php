<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Звязок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Дякуємо, що зв'язалися з нами. Ми відповімо вам якомога швидше.
        </div>

        <p>
            Зауважте, що якщо ви ввімкнете відладчик Yii, ви повинні мати змогу
            щоб переглянути поштові повідомлення на поштовій панелі налагоджувача.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Оскільки програма знаходиться в режимі розробки, це повідомлення не надсилається, але зберігається як
                файл під <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Будь ласка, налаштуйте<code>useFileTransport</code> property of the <code>mail</code>
                компонент додатка бути помилковим, щоб дозволити надсилання електронної пошти.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            Якщо у вас є ділові запити чи інші питання, заповніть наступну форму, щоб зв'язатися з нами.
            Дякую.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Відправити повідомлення', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
