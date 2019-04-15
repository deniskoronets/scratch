<?php

namespace app\controllers;

use app\models\SendTaskModel;
use app\models\TasksSubmits;
use Yii;
use app\models\Tasks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
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
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tasks::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPupilIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tasks::find(),
        ]);

        return $this->render('pupil-index.php', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSend($id)
    {
        if (Yii::$app->user->identity->is_teacher) {
            throw new ForbiddenHttpException('No access');
        }

        $model = $this->findModel($id);

        $model = new SendTaskModel($model);

        if (Yii::$app->request->isPost) {

            $model->answer = UploadedFile::getInstance($model, 'answer');

            if ($model->save()) {
                return $this->redirect('pupil-index');
            }
        }

        return $this->render('send', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Tasks model.
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

    public function actionPupilView($id)
    {
        if (Yii::$app->user->identity->is_teacher) {
            throw new ForbiddenHttpException('No access');
        }

        return $this->render('pupil-view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();

        $model->teacher_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        Yii::$app->db->transaction(function() use ($id) {

            TasksSubmits::deleteAll(['task_id' => $id]);

            $this->findModel($id)->delete();
        });

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
