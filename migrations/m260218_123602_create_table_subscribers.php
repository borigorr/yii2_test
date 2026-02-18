<?php

use yii\db\Migration;

class m260218_123602_create_table_subscribers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscribers}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->bigInteger()->notNull()->unique(),
            'author_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('subscribers_author_id',   '{{%subscribers}}', 'author_id', '{{%authors}}', 'id', );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260218_123602_create_table_subscribers cannot be reverted.\n";

        return false;
    }

}
