<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m170411_064725_create_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'status' => $this->string()->notNull(),
            'action' => $this->string()->notNull(),
            'date' => $this->Timestamp()->notNull(),
        ]);

        $this->createIndex(
            'idx-post-id_user',
            'status',
            'id_user'
        );


        $this->addForeignKey(
            'fk-post-id_user',
            'status',
            'id_user',
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
        $this->dropTable('status');
    }
}
