<?php

use yii\db\Migration;

/**
 * Class m190404_204802_init
 */
class m190404_204802_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(),
            'school' => $this->string(),
            'class' => $this->string(),
            'fio_teacher' => $this->string(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'is_teacher' => $this->boolean(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'teacher_id' => $this->integer(),
            'content' => 'MEDIUMTEXT',
            'test_id' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable('tests', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable('test_questions', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer(),
            'question' => $this->string(),
            'variant_1' => $this->string(),
            'variant_2' => $this->string(),
            'variant_3' => $this->string(),
            'variant_4' => $this->string(),
            'right_variant' => $this->smallInteger(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable('test_submits', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'test_id' => $this->integer(),
            'percent_pass' => $this->float(),
            'passed_at' => $this->timestamp(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable('tasks_submits', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'task_id' => $this->integer(),
            'file_path' => $this->string(),
            'submitted_at' => $this->timestamp(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190404_204802_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190404_204802_init cannot be reverted.\n";

        return false;
    }
    */
}
