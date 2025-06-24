<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m250624_103345_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'pages' => $this->integer()->notNull(),
            'language' => $this->string(50)->notNull(),
            'genre' => $this->string(50)->notNull(),
            'description' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk-books-author_id',
            '{{%books}}',
            'author_id',
            '{{%authors}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-books-author_id', '{{%books}}');
        $this->dropTable('{{%books}}');
    }
}
