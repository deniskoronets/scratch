<?php

namespace app\controllers;

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class PupilsReportController extends Controller
{
    public function actionReport()
    {
        return $this->render('report', [
            'dataProvider' => new ActiveDataProvider([
                'query' => User::find()->where(['!=', 'is_teacher', true]),
            ])
        ]);
    }
}