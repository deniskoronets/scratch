<?php

use yii\db\Migration;

/**
 * Class m190508_201743_add_class_to_tasks
 */
class m190508_201743_add_class_to_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'class_id', $this->integer());
        $this->dropColumn('user', 'class');
        $this->addColumn('user', 'class_id', $this->integer());

        $this->createTable('classes', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tasks', 'class');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190508_201743_add_class_to_tasks cannot be reverted.\n";

        return false;
    }
    */
}
