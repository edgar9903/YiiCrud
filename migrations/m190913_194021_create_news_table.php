<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m190913_194021_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string()->null(),
            'description' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
