<?php

use yii\db\Migration;

/**
 * Class m230409_193545_create_tables
 */
class m230409_193545_create_tables extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('fruits', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'family' => $this->string()->notNull(),
            'genus' => $this->string()->notNull(),
            'order' =>  $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->createTable('favorites', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'fruit_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_favorites_user_id', 'favorites', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_favorites_fruit_id', 'favorites', 'fruit_id', 'fruits', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk_favorites_user_id', 'favorites');
        $this->dropForeignKey('fk_favorites_fruit_id', 'favorites');
        $this->dropTable('favorites');
        $this->dropTable('fruits');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m230409_193545_create_tables cannot be reverted.\n";

      return false;
      }
     */
}
