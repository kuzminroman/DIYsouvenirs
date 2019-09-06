<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%advert}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 */
class m190905_181223_create_advert_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%advert}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'price' => $this->string(),
            'date_created' => $this->datetime(),
            'date_updated' => $this->datetime(),
            'date_sale' => $this->datetime(),
            'status' => $this->integer()->defaultValue(1),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-advert-product_id}}',
            '{{%advert}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-advert-product_id}}',
            '{{%advert}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-advert-product_id}}',
            '{{%advert}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-advert-product_id}}',
            '{{%advert}}'
        );

        $this->dropTable('{{%advert}}');
    }
}
