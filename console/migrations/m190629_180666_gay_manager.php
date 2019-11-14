<?php

use yii\db\Schema;
use yii\db\Migration;
class m190629_180666_gay_manager extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{%gallery_temp}}',
            [
                'id' => Schema::TYPE_PK,
                'imageId' => Schema::TYPE_INTEGER,
                'temporaryIndex' => Schema::TYPE_INTEGER,
                'csrfToken' => Schema::TYPE_STRING,
                'userIdentityId' => Schema::TYPE_STRING,
                'sessionId' => Schema::TYPE_STRING,
            ]
        );
        $this->createIndex('{{%i_uiid}}', '{{%gallery_temp}}', 'userIdentityId');
        $this->addForeignKey('{{%fk_gallery_temp_to_gallery}}', '{{%gallery_temp}}', 'imageId', '{{%gallery_image}}', 'id', 'CASCADE', 'CASCADE');
        Yii::$app->db->schema->refresh();
    }
    public function down()
    {
        $this->dropTable('{{%gallery_temp}}');
        Yii::$app->db->schema->refresh();
    }
}