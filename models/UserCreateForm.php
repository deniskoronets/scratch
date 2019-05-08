<?php

namespace app\models;

class UserCreateForm extends \yii\base\Model
{
	public $fio;
	public $school;
	public $class_id;
	public $fio_teacher;
	public $username;
	public $email;
	public $password;
	public $is_teacher;

	public function rules()
	{
		return [
			[['fio', 'school', 'username', 'email', 'is_teacher'], 'required'],
            ['class_id', 'safe'],
            ['username', 'unique', 'targetClass' => User::class],
            [['fio_teacher','password'], 'safe'],
		];
	}

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function attributeLabels()
    {
        return [
            'fio' => 'Призвіще, імя та побатькові',
            'school' => 'Школа',
            'fio_teacher' => 'Викладач учня',
            'username' => 'Користувач',
            'class_id' => 'Класс',
            'is_teacher' => 'Вчитель?',
        ];
    }
	public function save()
	{
		if (!$this->validate()) {
			return false;
		}

		$user = new User;
		$user->setAttributes($this->attributes);

		if (empty($this->password)) {
            $this->password = $this->generateRandomString(8);
        }


		$user->setPassword($this->password);
		$user->password_reset_token = '';
		if ($this->is_teacher) {
		    $user->fio_teacher = '';
        }

		$user->auth_key = '';
		$user->password_reset_token = md5(uniqid());
		$user->created_at = time();
		$user->updated_at = time();

		if (!$user->save()) {
			$this->addError('fio', 'Під час збереження цієї моделі сталася помилка');
			return false;
		}

		\Yii::$app->mailer->compose('user-info', [
		    'username' => $this->username,
            'password' => $this->password,
        ])
            ->setFrom('help@scratch-zp.pp.ua')
            ->setTo($this->email)
            ->setSubject('Добро пожаловать!')
            ->send();

		return true;
	}
}