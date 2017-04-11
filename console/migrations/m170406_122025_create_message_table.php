<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m170406_122025_create_message_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'id_user_out' => $this->integer()->notNull(),
            'messages' => $this->string()->notNull(),
            'id_user_in' => $this->integer()->notNull(),
            'date' => $this->Timestamp()->notNull(),
        ]);



            $this->createIndex(
                'idx-post-id_user_out',
                'message',
                'id_user_out'
            );


        $this->addForeignKey(
            'fk-post-id_user_out',
            'message',
            'id_user_out',
            'user',
            'id',
            'CASCADE'
        );





    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('message');
    }
}
