<?php

use yii\db\Migration;


/**
 * Handles the creation of table `city`.
 */
class m170321_194245_create_city_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'region' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
        ]);


        $this->insert('city', [
            'region' => 'Витебская область',
            'description' => 'Новополоцк',
        ]);
        $this->insert('city', [
            'region' => 'Минская область',
            'description' => 'Молодечно',
        ]);
        $this->insert('city', [
            'region' => 'Гомельская область',
            'description' => 'Барановичи',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('city');
    }
}
