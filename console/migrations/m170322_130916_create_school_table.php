<?php

use yii\db\Migration;

/**
 * Handles the creation of table `school`.
 */
class m170322_130916_create_school_table extends Migration
{
    /**
     * @inheritdoc
     */

    public function up()
    {
        $this->createTable('school', [
            'id' => $this->primaryKey(),
            'id_city' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'kol' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-post-id_city',
            'school',
            'id_city'
        );


        $this->addForeignKey(
            'fk-post-id_city',
            'school',
            'id_city',
            'city',
            'id',
            'CASCADE'
        );



        $this->insert('school', [
            'name' => 'ПГУ',
            'id_city' => 1,
            'kol' => 5,
        ]);
        $this->insert('school', [
            'name' => 'СОУ',
            'id_city' => 2,
            'kol' => 10,
        ]);
    }





/**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('school');
    }
}
