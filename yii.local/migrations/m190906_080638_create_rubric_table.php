<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rubric}}`.
 */
class m190906_080638_create_rubric_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{rubric}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rubric}}');
    }
}
