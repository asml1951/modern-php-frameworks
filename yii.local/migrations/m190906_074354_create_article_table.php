<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{article}}`.
 */
class m190906_074354_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200),
            'content' => $this->text(1000),
            'published' => $this->dateTime(),
            'modified' => $this->dateTime(),
            'rubric' => $this->integer(11),
            'arch' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
