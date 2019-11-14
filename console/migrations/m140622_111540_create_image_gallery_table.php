<?php

use yii\db\Schema;

class m140622_111540_create_image_gallery_table extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('image_gallery', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'alt' => $this->string(255),
            'filePath' => $this->string(400)->notNull(),
            'modelName' => $this->string(150)->notNull(),
            'description' => $this->text(),
            'gallery_name' => $this->string(150),
        ]);
    }

    public function down()
    {
        echo "m140622_666666_create_image_table cannot be reverted.\n";

        return false;
    }
}