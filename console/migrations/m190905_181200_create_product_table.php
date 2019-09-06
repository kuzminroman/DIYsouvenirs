<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 */
class m190905_181200_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'cathegory_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `cathegory_id`
        $this->createIndex(
            '{{%idx-product-cathegory_id}}',
            '{{%product}}',
            'cathegory_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-product-cathegory_id}}',
            '{{%product}}',
            'cathegory_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-product-cathegory_id}}',
            '{{%product}}'
        );

        // drops index for column `cathegory_id`
        $this->dropIndex(
            '{{%idx-product-cathegory_id}}',
            '{{%product}}'
        );

        $this->dropTable('{{%product}}');
    }
}
