<?php

namespace app\models;
use yii\helpers\FileHelper;

class SendTaskModel extends \yii\base\Model
{
	const PATH_UPLOAD = '@webroot/tasks_results/';

	public $answer;

    /**
     * @var Tasks
     */
	private $model;

	public function __construct($model)
    {
        $this->model = $model;
    }

    public function rules()
	{
		return [
			[['answer'], 'file', 'skipOnEmpty' => false, 'extensions' => 'sb2,sb3,sb1,sb', 'maxSize' => 10485760, 'checkExtensionByMimeType' => false],
		];
	}

	public function save()
	{
		if (!$this->validate()) {
			return false;
		}

		$user = \Yii::$app->user->identity;
		$path = \Yii::getAlias(self::PATH_UPLOAD).'/'.$user->username.'/';
    	FileHelper::createDirectory($path);
		$answer_file_name =  date('d-m-Y_H_i_s') . '.' . $this->answer->extension;
		$this->answer->saveAs($path .'/'. $answer_file_name);

		$model = new TasksSubmits();
		$model->user_id = $user->id;
		$model->task_id = $this->model->id;
		$model->file_path = $answer_file_name;
		$model->submitted_at = date('Y-m-d H:i:s');
		if (!$model->save()) {
		    var_dump($model->getErrors()); exit;
        }

		return true;
	}

	public function alreadySend()
	{
		return !empty(\Yii::$app->user->identity->answer_file_name);
	}
}