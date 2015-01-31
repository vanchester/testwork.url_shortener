<?php

class Url extends CActiveRecord
{
    public $code;
    public $link;
    public $created;

    const CODE_ALLOWED_SYMBOLS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const CODE_LENGTH = 5;

    public function __construct($scenario = 'insert')
    {
        if (!$this->getDbConnection()->getSchema()->getTable($this->tableName())) {
            $this->runMigrations();
        }

        parent::__construct($scenario);
    }

    /**
     * Запуск миграций
     * Для быстрого разворачивания приложения при демонстрации
     */
    private function runMigrations()
    {
        $commandPath = Yii::app()->getBasePath() . '/commands';
        $runner = new CConsoleCommandRunner();
        $runner->addCommands($commandPath);
        $commandPath = Yii::getFrameworkPath() . '/cli/commands';
        $runner->addCommands($commandPath);
        $args = ['yiic', 'migrate', '--interactive=0'];
        ob_start();
        $runner->run($args);
        ob_get_clean();
    }

    public function tableName()
    {
        return 'url';
    }

    public function rules()
    {
        return [
            ['code', 'unique', 'caseSensitive' => true],
            ['link', 'required', 'message' => Yii::t('url', 'Invalid link')],
            ['link', 'url', 'message' => Yii::t('url', 'Invalid link')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'link' => Yii::t('url', 'Link')
        ];
    }

    public function primaryKey()
    {
        return 'code';
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Url the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    private function generateCode($length = self::CODE_LENGTH)
    {
        $symbols = str_shuffle(self::CODE_ALLOWED_SYMBOLS);
        $code = '';
        while (strlen($code) < $length) {
            $code .= $symbols[rand(0, strlen($symbols) - 1)];
        }
        return $code;
    }

    public function beforeValidate()
    {
        $this->code = $this->generateCode();
        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        if ($this->hasErrors('code')) {
            $this->validate();
            return;
        }

        parent::afterValidate();
    }
}
