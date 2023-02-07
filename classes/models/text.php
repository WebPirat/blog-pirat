<?php
namespace models;
require_once ('autoloader.php');

class text
{
    private $database;
    private $settings;

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
    }

    /**
     * @param $name
     * @return string
     */
    public function getTextByName($name) : string
    {
        return $this->database->query('SELECT * FROM text WHERE name = ?', $name)->fetchString('content');
    }

    public function getAllTextVars() : array
    {
        return $this->database->query('SELECT name, content FROM text_var')->fetchAll();
    }
}