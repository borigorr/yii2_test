<?php

use yii\db\Migration;

class m260217_110755_create_table_authors_books extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%authors_books}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'author_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk_authors_books', 'authors_books', 'book_id', '{{%books}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_authors_authors', 'authors_books', 'author_id', '{{%authors}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('unique_authors_books', 'authors_books', ['book_id', 'author_id'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_authors_books', 'authors_books');
        $this->dropForeignKey('fk_authors_authors', 'authors_books');
        $this->dropIndex('unique_authors_books', 'authors_books');
        $this->dropTable('{{%authors_books}}');
    }

}
