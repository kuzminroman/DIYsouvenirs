<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%claim}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%advert}}`
 */
class m190905_182449_create_claim_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%claim}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'advert_id' => $this->integer()->notNull(),
            'status' => $this->integer(),
            'date_claim' => $this->datetime(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-claim-user_id}}',
            '{{%claim}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-claim-user_id}}',
            '{{%claim}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `advert_id`
        $this->createIndex(
            '{{%idx-claim-advert_id}}',
            '{{%claim}}',
            'advert_id'
        );

        // add foreign key for table `{{%advert}}`
        $this->addForeignKey(
            '{{%fk-claim-advert_id}}',
            '{{%claim}}',
            'advert_id',
            '{{%advert}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-claim-user_id}}',
            '{{%claim}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-claim-user_id}}',
            '{{%claim}}'
        );

        // drops foreign key for table `{{%advert}}`
        $this->dropForeignKey(
            '{{%fk-claim-advert_id}}',
            '{{%claim}}'
        );

        // drops index for column `advert_id`
        $this->dropIndex(
            '{{%idx-claim-advert_id}}',
            '{{%claim}}'
        );

        $this->dropTable('{{%claim}}');
    }
}
