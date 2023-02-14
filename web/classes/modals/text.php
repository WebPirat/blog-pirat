<?php
namespace modals;
use core\db;
use core\settings;
use helper\parseArray;

require_once ('autoloader.php');

class text
{
    private object $database;
    private object $settings;
    private object $parseArray;

    public array $allText;

    public function __construct()
    {
        $this->database = new db();
        $this->settings = new settings();
        $this->parseArray = new parseArray();
        $this->allText = $this->getAllTextVars();
    }

    /**
     * @param $name
     * @return string
     */
    public function getTextByName($name) : string
    {
        $needle['name'] = $name;
        return $this->parseArray->findSingleInArray($this->allText, $needle, 'content');
    }

    public function getAllTextVars() : array
    {
        return $this->database->query('SELECT name, content FROM text_var')->fetchAll();
    }
}