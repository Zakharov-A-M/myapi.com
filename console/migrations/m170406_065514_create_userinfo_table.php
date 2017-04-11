<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userinfo`.
 */
class m170406_065514_create_userinfo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('userinfo', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'surname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
        ]);

                $this->createIndex(
                    'idx-post-id_user',
                    'userinfo',
                    'id_user'
                );


            $this->addForeignKey(
                'fk-post-id_user',
                'userinfo',
                'id_user',
                'user',
                'id',
                'CASCADE'
            );


        $this->insert('userinfo', [
            'id_user' => '1',
            'surname' => 'Захаров',
            'name' => 'Александр',
            'lastname' => 'Михайлович',
            'city' => 'Осташков',
            'phone' => '+375(33)660-85-44',
        ]);

        $this->insert('userinfo', [
            'id_user' => '4',
            'surname' => 'Гаевский',
            'name' => 'Илья',
            'lastname' => 'Андреевич',
            'city' => 'Глубокое',
            'phone' => '+375(29)296-19-10',
        ]);




    }




    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('userinfo');
    }
}
