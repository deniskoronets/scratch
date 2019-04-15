<?php

namespace app\controllers;

use app\models\PassTestForm;
use app\models\Tasks;
use app\models\TestCreateForm;
use app\models\TestQuestions;
use app\models\TestSubmits;
use app\models\TestUpdateForm;
use Yii;
use app\models\Test;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestsController implements the CRUD actions for Test model.
 */
class TestsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Test::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TestCreateForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $right = [];

        foreach (range(1, 4) as $v) {
            $right[$v] = $v;
        }

        return $this->render('create', [
            'model' => $model,
            'variants' => $right,
        ]);
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new TestUpdateForm($this->findModel($id));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $right = [];

        foreach (range(1, 4) as $v) {
            $right[$v] = $v;
        }

        return $this->render('update', [
            'model' => $model,
            'variants' => $right,
        ]);
    }

    public function actionDelete($id)
    {
        Yii::$app->db->transaction(function() use ($id) {

            TestSubmits::deleteAll(['test_id' => $id]);

            TestQuestions::deleteAll(['test_id' => $id]);

            Tasks::updateAll(
                ['test_id' => null],
                ['test_id' => $id]
            );

            $this->findModel($id)->delete();
        });

        return $this->redirect(['index']);
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPassTest($id)
    {
        $model = new PassTestForm($this->findModel($id));

        if ($model->load(Yii::$app->request->post()) && $model->submit()) {
            return $this->redirect(['tasks/pupil-index']);
        }

        return $this->render('pass-test', [
            'model' => $model,
        ]);
    }
}
