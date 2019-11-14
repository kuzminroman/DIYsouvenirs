<?php

use yii\db\Schema;

class m190929_215240_modify_product_table extends \yii\db\Migration
{
    public function up()
    {
        $this->addColumn('product', 'image_id', 'integer');
        $this->addForeignKey('PI', 'product', 'image_id', 'image_gallery', 'id');
    }

    public function down()
    {
        $this->dropColumn('product', 'image_id');
        return false;
    }
}