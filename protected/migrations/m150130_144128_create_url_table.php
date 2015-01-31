<?php

class m150130_144128_create_url_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('url', [
            'code' => 'char(' . Url::CODE_LENGTH . ') BINARY NOT NULL',
            'link' => 'text NOT NULL',
            'created' => 'timestamp NOT NULL DEFAULT NOW()',
            'UNIQUE KEY (code)'
        ]);
    }

    public function down()
    {
        $this->dropTable('url');
        return true;
    }
}
